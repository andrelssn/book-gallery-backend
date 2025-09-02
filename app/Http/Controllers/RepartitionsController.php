<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Api\Repartitions\RepartitionsService;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class RepartitionsController extends Controller
{

    private $repartitionsService;

    public function __construct(RepartitionsService $repartitionsService)
    {
        $this->repartitionsService = $repartitionsService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $requisition = $this->repartitionsService->getRepartitions($request);

        if (!$requisition) {
            throw new HttpResponseException(response()->json([
                'error' => "An error has ocurred during the requisition."
            ], 422));
        }

        return response()->json([
            'status'    => true,
            'message'   => "Repartitions list.",
            'data'      => $requisition
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requisition = $this->repartitionsService->storeRepartition($request);

        if (!$requisition) {
            throw new HttpResponseException(response()->json([
                'error' => "An error has ocurred during the requisition."
            ], 422));
        }

        return response()->json([
            'status' => true,
            'message' => "Repartition created.",
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $requisition = $this->repartitionsService->updateRepartition($request, $id);

        if (!$requisition) {
            throw new HttpResponseException(response()->json([
                'error' => "An error has ocurred during the requisition."
            ], 422));
        }

        return response()->json([
            'status' => true,
            'message' => "Repartition info updated.",
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $requisition = $this->repartitionsService->deleteRepartition($id);

        if (!$requisition) {
            throw new HttpResponseException(response()->json([
                'error' => "An error has ocurred during the requisition."
            ], 422));
        }

        return response()->json([
            'status' => true,
            'message' => "Repartition deleted.",
        ], 200);
    }
}
