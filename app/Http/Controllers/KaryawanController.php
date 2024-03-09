<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateKaryawanRequest;
use App\Http\Requests\UpdateKaryawanRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\KaryawanRepository;
use Illuminate\Http\Request;
use App\Models\Dapartemen;
use App\Models\Karyawan;
use Flash;
use Auth;

class KaryawanController extends AppBaseController
{
    /** @var KaryawanRepository $karyawanRepository*/
    private $karyawanRepository;

    public function __construct(KaryawanRepository $karyawanRepo)
    {
        $this->middleware('permission:karyawan.index', ['only' => ['index','show']]);
        $this->middleware('permission:karyawan.create', ['only' => ['create','store']]);
        $this->middleware('permission:karyawan.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:karyawan.destroy', ['only' => ['destroy']]);
        $this->karyawanRepository = $karyawanRepo;
    }

    /**
     * Display a listing of the Karyawan.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        if ($user->hasRole(['super-admin','administrasi'])) {
            $karyawans = $this->karyawanRepository->paginate(10);
        }else if($user->hasRole(['supervisor','manager'])){
            $dapartemenUser = $user->dapartemen();
            $karyawans = Karyawan::where('dapartement_id',$dapartemenUser->id)->paginate(10);
        }

        return view('karyawans.index')->with('karyawans', $karyawans);
    }

    /**
     * Show the form for creating a new Karyawan.
     */
    public function create()
    {
        $dapartemens = Dapartemen::orderBy('name')->pluck('name','id');

        return view('karyawans.create',compact('dapartemens'));
    }

    /**
     * Store a newly created Karyawan in storage.
     */
    public function store(CreateKaryawanRequest $request)
    {
        $input = $request->all();

        $karyawan = $this->karyawanRepository->create($input);

        Flash::success('Karyawan saved successfully.');
        return redirect(route('karyawans.index'));
    }

    /**
     * Display the specified Karyawan.
     */
    public function show($id)
    {
        $karyawan = $this->karyawanRepository->find($id);
        
        if (empty($karyawan)) {
            Flash::error('Karyawan not found');
            return redirect(route('karyawans.index'));
        }

        return view('karyawans.show')->with('karyawan', $karyawan);
    }

    /**
     * Show the form for editing the specified Karyawan.
     */
    public function edit($id)
    {
        $karyawan = $this->karyawanRepository->find($id);

        if (empty($karyawan)) {
            Flash::error('Karyawan not found');
            return redirect(route('karyawans.index'));
        }

        $dapartemens = Dapartemen::orderBy('name')->pluck('name','id');

        return view('karyawans.edit', compact('karyawan','dapartemens'));
    }

    /**
     * Update the specified Karyawan in storage.
     */
    public function update($id, UpdateKaryawanRequest $request)
    {
        $karyawan = $this->karyawanRepository->find($id);

        if (empty($karyawan)) {
            Flash::error('Karyawan not found');
            return redirect(route('karyawans.index'));
        }

        $karyawan = $this->karyawanRepository->update($request->all(), $id);

        Flash::success('Karyawan updated successfully.');
        return redirect(route('karyawans.index'));
    }

    /**
     * Remove the specified Karyawan from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $karyawan = $this->karyawanRepository->find($id);

        if (empty($karyawan)) {
            Flash::error('Karyawan not found');
            return redirect(route('karyawans.index'));
        }

        $this->karyawanRepository->delete($id);

        Flash::success('Karyawan deleted successfully.');
        return redirect(route('karyawans.index'));
    }
}
