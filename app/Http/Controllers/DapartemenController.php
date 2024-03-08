<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDapartemenRequest;
use App\Http\Requests\UpdateDapartemenRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\DapartemenRepository;
use Illuminate\Http\Request;
use Flash;

class DapartemenController extends AppBaseController
{
    /** @var DapartemenRepository $dapartemenRepository*/
    private $dapartemenRepository;

    public function __construct(DapartemenRepository $dapartemenRepo)
    {
        $this->middleware('permission:dapartemen.index', ['only' => ['index','show']]);
        $this->middleware('permission:dapartemen.create', ['only' => ['create','store']]);
        $this->middleware('permission:dapartemen.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:dapartemen.destroy', ['only' => ['destroy']]);
        $this->dapartemenRepository = $dapartemenRepo;
    }

    /**
     * Display a listing of the Dapartemen.
     */
    public function index(Request $request)
    {
        $dapartemens = $this->dapartemenRepository->paginate(10);

        return view('dapartemens.index')->with('dapartemens', $dapartemens);
    }

    /**
     * Show the form for creating a new Dapartemen.
     */
    public function create()
    {
        return view('dapartemens.create');
    }

    /**
     * Store a newly created Dapartemen in storage.
     */
    public function store(CreateDapartemenRequest $request)
    {
        $input = $request->all();

        $dapartemen = $this->dapartemenRepository->create($input);

        Flash::success('Dapartemen saved successfully.');
        return redirect(route('dapartemens.index'));
    }

    /**
     * Display the specified Dapartemen.
     */
    public function show($id)
    {
        $dapartemen = $this->dapartemenRepository->find($id);
        
        if (empty($dapartemen)) {
            Flash::error('Dapartemen not found');
            return redirect(route('dapartemens.index'));
        }

        return view('dapartemens.show')->with('dapartemen', $dapartemen);
    }

    /**
     * Show the form for editing the specified Dapartemen.
     */
    public function edit($id)
    {
        $dapartemen = $this->dapartemenRepository->find($id);

        if (empty($dapartemen)) {
            Flash::error('Dapartemen not found');
            return redirect(route('dapartemens.index'));
        }

        return view('dapartemens.edit')->with('dapartemen', $dapartemen);
    }

    /**
     * Update the specified Dapartemen in storage.
     */
    public function update($id, UpdateDapartemenRequest $request)
    {
        $dapartemen = $this->dapartemenRepository->find($id);

        if (empty($dapartemen)) {
            Flash::error('Dapartemen not found');
            return redirect(route('dapartemens.index'));
        }

        $dapartemen = $this->dapartemenRepository->update($request->all(), $id);

        Flash::success('Dapartemen updated successfully.');
        return redirect(route('dapartemens.index'));
    }

    /**
     * Remove the specified Dapartemen from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $dapartemen = $this->dapartemenRepository->find($id);

        if (empty($dapartemen)) {
            Flash::error('Dapartemen not found');
            return redirect(route('dapartemens.index'));
        }

        $this->dapartemenRepository->delete($id);

        Flash::success('Dapartemen deleted successfully.');
        return redirect(route('dapartemens.index'));
    }
}
