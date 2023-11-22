<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateKucingRequest;
use App\Http\Requests\UpdateKucingRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\KucingRepository;
use Illuminate\Http\Request;
use Flash;

class KucingController extends AppBaseController
{
    /** @var KucingRepository $kucingRepository*/
    private $kucingRepository;

    public function __construct(KucingRepository $kucingRepo)
    {
        $this->middleware('permission:kucing.index', ['only' => ['index','show']]);
        $this->middleware('permission:kucing.create', ['only' => ['create','store']]);
        $this->middleware('permission:kucing.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:kucing.destroy', ['only' => ['destroy']]);
        $this->kucingRepository = $kucingRepo;
    }

    /**
     * Display a listing of the Kucing.
     */
    public function index(Request $request)
    {
        $kucings = $this->kucingRepository->paginate(10);

        return view('kucings.index')->with('kucings', $kucings);
    }

    /**
     * Show the form for creating a new Kucing.
     */
    public function create()
    {
        return view('kucings.create');
    }

    /**
     * Store a newly created Kucing in storage.
     */
    public function store(CreateKucingRequest $request)
    {
        $input = $request->all();

        $kucing = $this->kucingRepository->create($input);

        Flash::success('Kucing saved successfully.');
        return redirect(route('kucings.index'));
    }

    /**
     * Display the specified Kucing.
     */
    public function show($id)
    {
        $kucing = $this->kucingRepository->find($id);
        
        if (empty($kucing)) {
            Flash::error('Kucing not found');
            return redirect(route('kucings.index'));
        }

        return view('kucings.show')->with('kucing', $kucing);
    }

    /**
     * Show the form for editing the specified Kucing.
     */
    public function edit($id)
    {
        $kucing = $this->kucingRepository->find($id);

        if (empty($kucing)) {
            Flash::error('Kucing not found');
            return redirect(route('kucings.index'));
        }

        return view('kucings.edit')->with('kucing', $kucing);
    }

    /**
     * Update the specified Kucing in storage.
     */
    public function update($id, UpdateKucingRequest $request)
    {
        $kucing = $this->kucingRepository->find($id);

        if (empty($kucing)) {
            Flash::error('Kucing not found');
            return redirect(route('kucings.index'));
        }

        $kucing = $this->kucingRepository->update($request->all(), $id);

        Flash::success('Kucing updated successfully.');
        return redirect(route('kucings.index'));
    }

    /**
     * Remove the specified Kucing from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $kucing = $this->kucingRepository->find($id);

        if (empty($kucing)) {
            Flash::error('Kucing not found');
            return redirect(route('kucings.index'));
        }

        $this->kucingRepository->delete($id);

        Flash::success('Kucing deleted successfully.');
        return redirect(route('kucings.index'));
    }
}
