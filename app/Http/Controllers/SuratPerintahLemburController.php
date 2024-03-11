<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSuratPerintahLemburRequest;
use App\Http\Requests\UpdateSuratPerintahLemburRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\SuratPerintahLemburRepository;
use Illuminate\Http\Request;
use App\Models\SuratPerintahLembur;
use App\Models\Karyawan;
use App\Models\SPLStatus;
use App\Models\Dapartemen;
use Flash;
use DB;
use Carbon\Carbon;

class SuratPerintahLemburController extends AppBaseController
{
    /** @var SuratPerintahLemburRepository $suratPerintahLemburRepository*/
    private $suratPerintahLemburRepository;

    public function __construct(SuratPerintahLemburRepository $suratPerintahLemburRepo)
    {
        $this->middleware('permission:suratPerintahLembur.index', ['only' => ['index','show']]);
        $this->middleware('permission:suratPerintahLembur.create', ['only' => ['create','store']]);
        $this->middleware('permission:suratPerintahLembur.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:suratPerintahLembur.destroy', ['only' => ['destroy']]);
        $this->suratPerintahLemburRepository = $suratPerintahLemburRepo;
    }

    /**
     * Display a listing of the SuratPerintahLembur.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $selectedDepartment = $request->input('department');
        $selectedStatus = $request->input('statuss');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = SuratPerintahLembur::with('karyawan', 'splStatusLatest');

        if ($selectedDepartment) {
            $query->whereHas('karyawan', function ($query) use ($selectedDepartment) {
                $query->where('dapartement_id', $selectedDepartment);
            });
        } elseif (!$user->hasRole('administrasi')) {
            $query->whereHas('karyawan', function ($query) use ($user) {
                $query->where('dapartement_id', $user->dapartemen()->id);
            });
        }

        if ($selectedStatus) {
            $query->whereHas('splStatusLatest', function ($query) use ($selectedStatus) {
                $query->where('status', $selectedStatus);
            });
        }

        if ($startDate) {
            $query->whereDate('mulai', '>=', $startDate);
        }
    
        if ($endDate) {
            $query->whereDate('selesai', '<=', $endDate);
        }
    

        $suratPerintahLemburs = $query->get();

        foreach ($suratPerintahLemburs as $item) {
            $item->spl_status_latest_status = strtoupper($item->splStatusLatest->status);
            $item->spl_status_latest_status_color = $this->badgeColor($item->splStatusLatest->status);
        }

        $departments = Dapartemen::orderBy('name', 'asc')->get();

        return view('surat_perintah_lemburs.index', compact('suratPerintahLemburs', 'user', 'departments'));
    }


    private function badgeColor($status) : string {
        switch ($status) {
            case 'draft':
                return 'bg-secondary'; // Gray
                break;
            case 'menunggu':
                return 'bg-primary'; // Blue
                break;
            case 'revisi':
                return 'bg-warning'; // Yellow
                break;
            case 'disetujui':
                return 'bg-success'; // Green
                break;
            case 'ditolak':
                return 'bg-danger'; // Red
                break;
            default:
                return 'bg-light'; // Light gray (default)
        }
    }

    /**
     * Show the form for creating a new SuratPerintahLembur.
     */
    public function create(Request $request)
    {
        $choisKaryawanId = $request->query('karyawanId');
        $dapartemenUser = auth()->user()->dapartemen();
        $karyawans = Karyawan::where('dapartement_id', $dapartemenUser->id)->orderBy('name', 'asc')->pluck('name', 'id');

        return view('surat_perintah_lemburs.create', compact('karyawans','choisKaryawanId'));
    }

    /**
     * Store a newly created SuratPerintahLembur in storage.
     */
    public function store(CreateSuratPerintahLemburRequest $request)
    {
        $input = $request->all();

        // Ambil nilai "Mulai" dan "Selesai" dari input
        $mulai = Carbon::parse($input['mulai']);
        $selesai = Carbon::parse($input['selesai']);

        // Hitung selisih waktu dalam jam dan simpan sebagai format time
        $selisihWaktu = $selesai->diff($mulai);

        // Konversi DateInterval ke total menit
        $totalMenit = $selisihWaktu->days * 24 * 60 + // Menit dalam hari
            $selisihWaktu->h * 60 +         // Menit dalam jam
            $selisihWaktu->i;   // Menit
        $totalMenit = (int)$totalMenit;  
        
        // jika selisih waktu kurang dari 5 menit, maka tampilkan error
        if ($totalMenit < 5) {
            Flash::error('Waktu lembur tidak boleh kurang dari 5 menit');
            return redirect(route('suratPerintahLemburs.create'));
        }

        // jika lembur lebih dari 23 jam, maka tampilkan error
        if ($totalMenit > 1380) {
            Flash::error('Waktu lembur tidak boleh lebih dari 8 jam');
            return redirect(route('suratPerintahLemburs.create'));
        }

        $input['total_jam_lembur'] = $selisihWaktu->format('%H:%I:%S');

        $user = auth()->user();

        DB::transaction(function () use ($input, $user) {
            $suratPerintahLembur = $this->suratPerintahLemburRepository->create($input);
            SPLStatus::create([
                'approved_by' => $user->id,
                'surat_perintah_lembur_id' => $suratPerintahLembur->id,
                'status' => 'menunggu',
                'message' => 'Surat Perintah Lembur telah dibuat oleh '. $user->name
            ]);
        });

        Flash::success('Surat Perintah Lembur saved successfully.');
        return redirect(route('suratPerintahLemburs.index'));
    }

    /**
     * Display the specified SuratPerintahLembur.
     */
    public function show($id)
    {
        $suratPerintahLembur = $this->suratPerintahLemburRepository->find($id);
        
        if (empty($suratPerintahLembur)) {
            Flash::error('Surat Perintah Lembur not found');
            return redirect(route('suratPerintahLemburs.index'));
        }

        return view('surat_perintah_lemburs.show')->with('suratPerintahLembur', $suratPerintahLembur);
    }

    /**
     * Show the form for editing the specified SuratPerintahLembur.
     */
    public function edit($id)
    {
        $suratPerintahLembur = $this->suratPerintahLemburRepository->find($id);

        if (empty($suratPerintahLembur)) {
            Flash::error('Surat Perintah Lembur not found');
            return redirect(route('suratPerintahLemburs.index'));
        }
        
        $dapartemenUser = auth()->user()->dapartemen();
        $karyawans = Karyawan::where('dapartement_id', $dapartemenUser->id)->orderBy('name', 'asc')->pluck('name', 'id');
        $karyawanUser = Karyawan::find($suratPerintahLembur->karyawan_id);

        return view('surat_perintah_lemburs.edit', compact('suratPerintahLembur', 'karyawans','karyawanUser'));
    }

    /**
     * Update the specified SuratPerintahLembur in storage.
     */
    public function update($id, UpdateSuratPerintahLemburRequest $request)
    {
        $suratPerintahLembur = $this->suratPerintahLemburRepository->find($id);

        if (empty($suratPerintahLembur)) {
            Flash::error('Surat Perintah Lembur not found');
            return redirect(route('suratPerintahLemburs.index'));
        }

        $input = $request->all();

        // Ambil nilai "Mulai" dan "Selesai" dari input
        $mulai = Carbon::parse($input['mulai']);
        $selesai = Carbon::parse($input['selesai']);

        // Hitung selisih waktu dalam jam dan simpan sebagai format time
        $selisihWaktu = $selesai->diff($mulai);

        // Konversi DateInterval ke total menit
        $totalMenit = $selisihWaktu->days * 24 * 60 + // Menit dalam hari
            $selisihWaktu->h * 60 +         // Menit dalam jam
            $selisihWaktu->i;               // Menit
        $totalMenit = (int) $totalMenit;             
        
        // jika selisih waktu kurang dari 5 menit, maka tampilkan error
        if ($totalMenit < 5) {
            Flash::error('Waktu lembur tidak boleh kurang dari 5 menit');
            return redirect(route('suratPerintahLemburs.create'));
        }

        // jika selisih waktu lebih dari 23 jam, maka tampilkan error
        if ($totalMenit > 1380 ) {
            Flash::error('Waktu lembur tidak boleh lebih dari 8 jam');
            return redirect(route('suratPerintahLemburs.create'));
        }

        $input['total_jam_lembur'] = $selisihWaktu->format('%H:%I:%S');

        $user = auth()->user();

        DB::transaction(function () use ($input, $user, $id) {
            $suratPerintahLembur = $this->suratPerintahLemburRepository->update($input, $id);
            SPLStatus::create([
                'approved_by' => $user->id,
                'surat_perintah_lembur_id' => $suratPerintahLembur->id,
                'status' => 'menunggu',
                'message' => 'Surat Perintah Lembur telah diperbarui oleh '. $user->name
            ]);
        });

        Flash::success('Surat Perintah Lembur updated successfully.');
        return redirect(route('suratPerintahLemburs.index'));
    }

    /**
     * Remove the specified SuratPerintahLembur from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $suratPerintahLembur = $this->suratPerintahLemburRepository->find($id);

        if (empty($suratPerintahLembur)) {
            Flash::error('Surat Perintah Lembur not found');
            return redirect(route('suratPerintahLemburs.index'));
        }

        // hapus status splStatus
        DB::transaction(function () use ($suratPerintahLembur, $id) {
            SPLStatus::where('surat_perintah_lembur_id', $id)->delete();
            $this->suratPerintahLemburRepository->delete($id);
        });

        Flash::success('Surat Perintah Lembur deleted successfully.');
        return redirect(route('suratPerintahLemburs.index'));
    }

    function tanggapiView($id) {

        $suratPerintahLembur = $this->suratPerintahLemburRepository->find($id);
        
        if (empty($suratPerintahLembur)) {
            Flash::error('Surat Perintah Lembur not found');
            return redirect(route('suratPerintahLemburs.index'));
        }

        return view('surat_perintah_lemburs.tanggapi', compact('suratPerintahLembur','id'));
    }

    function tanggapi($id, Request $request) {
        $suratPerintahLembur = $this->suratPerintahLemburRepository->find($id);
        
        if (empty($suratPerintahLembur)) {
            Flash::error('Surat Perintah Lembur not found');
            return redirect(route('suratPerintahLemburs.index'));
        }

        $input = $request->all();
        $user = auth()->user();

        DB::transaction(function () use ($input, $user, $id) {
            SPLStatus::create([
                'approved_by' => $user->id,
                'surat_perintah_lembur_id' => $id,
                'status' => $input['status'],
                'message' => $input['message']
            ]);
        });

        Flash::success('Surat Perintah Lembur sudah ditanggapi.');
        return redirect(route('suratPerintahLemburs.index'));
    }

    function timeline($id) {
        $suratPerintahLembur = $this->suratPerintahLemburRepository->find($id);
        
        if (empty($suratPerintahLembur)) {
            Flash::error('Surat Perintah Lembur not found');
            return redirect(route('suratPerintahLemburs.index'));
        }

        $splStatuses = SPLStatus::where('surat_perintah_lembur_id', $id)->orderBy('created_at', 'desc')->get();

        return view('surat_perintah_lemburs.timeline', compact('suratPerintahLembur', 'splStatuses'));
    }
}
