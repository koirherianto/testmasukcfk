<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateKucingAPIRequest;
use App\Http\Requests\API\UpdateKucingAPIRequest;
use App\Models\Kucing;
use App\Repositories\KucingRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class KucingAPIController
 */
class KucingAPIController extends AppBaseController
{
    private KucingRepository $kucingRepository;

    public function __construct(KucingRepository $kucingRepo)
    {
        $this->kucingRepository = $kucingRepo;
    }

    /**
     * Display a listing of the Kucings.
     * GET|HEAD /kucings
     */
    public function index(Request $request): JsonResponse
    {
        $kucings = $this->kucingRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($kucings->toArray(), 'Kucings retrieved successfully');
    }

    /**
     * Store a newly created Kucing in storage.
     * POST /kucings
     */
    public function store(CreateKucingAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $kucing = $this->kucingRepository->create($input);

        return $this->sendResponse($kucing->toArray(), 'Kucing saved successfully');
    }

    /**
     * Display the specified Kucing.
     * GET|HEAD /kucings/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Kucing $kucing */
        $kucing = $this->kucingRepository->find($id);

        if (empty($kucing)) {
            return $this->sendError('Kucing not found');
        }

        return $this->sendResponse($kucing->toArray(), 'Kucing retrieved successfully');
    }

    /**
     * Update the specified Kucing in storage.
     * PUT/PATCH /kucings/{id}
     */
    public function update($id, UpdateKucingAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Kucing $kucing */
        $kucing = $this->kucingRepository->find($id);

        if (empty($kucing)) {
            return $this->sendError('Kucing not found');
        }

        $kucing = $this->kucingRepository->update($input, $id);

        return $this->sendResponse($kucing->toArray(), 'Kucing updated successfully');
    }

    /**
     * Remove the specified Kucing from storage.
     * DELETE /kucings/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Kucing $kucing */
        $kucing = $this->kucingRepository->find($id);

        if (empty($kucing)) {
            return $this->sendError('Kucing not found');
        }

        $kucing->delete();

        return $this->sendSuccess('Kucing deleted successfully');
    }
}
