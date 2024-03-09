<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSPLStatusRequest;
use App\Http\Requests\UpdateSPLStatusRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\SPLStatusRepository;
use Illuminate\Http\Request;
use Flash;

class SPLStatusController extends AppBaseController
{
    /** @var SPLStatusRepository $sPLStatusRepository*/
    private $sPLStatusRepository;

    public function __construct(SPLStatusRepository $sPLStatusRepo)
    {
        $this->middleware('permission:sPLStatus.index', ['only' => ['index','show']]);
        $this->middleware('permission:sPLStatus.create', ['only' => ['create','store']]);
        $this->middleware('permission:sPLStatus.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:sPLStatus.destroy', ['only' => ['destroy']]);
        $this->sPLStatusRepository = $sPLStatusRepo;
    }

    /**
     * Display a listing of the SPLStatus.
     */
    public function index(Request $request)
    {
        $sPLStatuses = $this->sPLStatusRepository->paginate(10);

        return view('s_p_l_statuses.index')->with('sPLStatuses', $sPLStatuses);
    }

    /**
     * Show the form for creating a new SPLStatus.
     */
    public function create()
    {
        return view('s_p_l_statuses.create');
    }

    /**
     * Store a newly created SPLStatus in storage.
     */
    public function store(CreateSPLStatusRequest $request)
    {
        $input = $request->all();

        $sPLStatus = $this->sPLStatusRepository->create($input);

        Flash::success('S P L Status saved successfully.');
        return redirect(route('sPLStatuses.index'));
    }

    /**
     * Display the specified SPLStatus.
     */
    public function show($id)
    {
        $sPLStatus = $this->sPLStatusRepository->find($id);
        
        if (empty($sPLStatus)) {
            Flash::error('S P L Status not found');
            return redirect(route('sPLStatuses.index'));
        }

        return view('s_p_l_statuses.show')->with('sPLStatus', $sPLStatus);
    }

    /**
     * Show the form for editing the specified SPLStatus.
     */
    public function edit($id)
    {
        $sPLStatus = $this->sPLStatusRepository->find($id);

        if (empty($sPLStatus)) {
            Flash::error('S P L Status not found');
            return redirect(route('sPLStatuses.index'));
        }

        return view('s_p_l_statuses.edit')->with('sPLStatus', $sPLStatus);
    }

    /**
     * Update the specified SPLStatus in storage.
     */
    public function update($id, UpdateSPLStatusRequest $request)
    {
        $sPLStatus = $this->sPLStatusRepository->find($id);

        if (empty($sPLStatus)) {
            Flash::error('S P L Status not found');
            return redirect(route('sPLStatuses.index'));
        }

        $sPLStatus = $this->sPLStatusRepository->update($request->all(), $id);

        Flash::success('S P L Status updated successfully.');
        return redirect(route('sPLStatuses.index'));
    }

    /**
     * Remove the specified SPLStatus from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $sPLStatus = $this->sPLStatusRepository->find($id);

        if (empty($sPLStatus)) {
            Flash::error('S P L Status not found');
            return redirect(route('sPLStatuses.index'));
        }

        $this->sPLStatusRepository->delete($id);

        Flash::success('S P L Status deleted successfully.');
        return redirect(route('sPLStatuses.index'));
    }
}
