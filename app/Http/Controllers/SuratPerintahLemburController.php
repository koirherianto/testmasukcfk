<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSuratPerintahLemburRequest;
use App\Http\Requests\UpdateSuratPerintahLemburRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\SuratPerintahLemburRepository;
use Illuminate\Http\Request;
use App\Models\SuratPerintahLembur;
use App\Models\Karyawan;
use Flash;
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
        $suratPerintahLemburs = SuratPerintahLembur::with('karyawan')->paginate(10);

        return view('surat_perintah_lemburs.index')->with('suratPerintahLemburs', $suratPerintahLemburs);
    }

    /**
     * Show the form for creating a new SuratPerintahLembur.
     */
    public function create()
    {
        $dapartemenUser = auth()->user()->dapartemen();
        $karyawans = Karyawan::where('dapartement_id', $dapartemenUser->id)->orderBy('name', 'asc')->pluck('name', 'id');

        return view('surat_perintah_lemburs.create', compact('karyawans'));
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

        // jika selisih waktu kurang dari 1 menit, maka tampilkan error
        if ($selisihWaktu->i < 0) {
            Flash::error('Waktu lembur tidak boleh kurang dari 1 menit');
            return redirect(route('suratPerintahLemburs.create'));
        }

        $input['total_jam_lembur'] = $selisihWaktu->format('%H:%I:%S');

        // Buat surat perintah lembur
        $suratPerintahLembur = $this->suratPerintahLemburRepository->create($input);

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

        // jika selisih waktu kurang dari 1 menit, maka tampilkan error
        if ($selisihWaktu->i < 0) {
            Flash::error('Waktu lembur tidak boleh kurang dari 1 menit');
            return redirect(route('suratPerintahLemburs.create'));
        }

        $input['total_jam_lembur'] = $selisihWaktu->format('%H:%I:%S');

        $suratPerintahLembur = $this->suratPerintahLemburRepository->update($input, $id);

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

        $this->suratPerintahLemburRepository->delete($id);

        Flash::success('Surat Perintah Lembur deleted successfully.');
        return redirect(route('suratPerintahLemburs.index'));
    }
}
