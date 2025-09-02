<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Api\Objectives\ObjectivesService;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class ObjectivesController extends Controller
{

    private $objectivesService;

    public function __construct(ObjectivesService $objectivesService)
    {
        $this->objectivesService = $objectivesService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $requisition = $this->objectivesService->getObjectives($request);

        if (!$requisition) {
            throw new HttpResponseException(response()->json([
                'error' => "An error has ocurred during the requisition."
            ], 422));
        }

        return response()->json([
            'status'    => true,
            'message'   => "Objectives list.",
            'data'      => $requisition
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requisition = $this->objectivesService->storeObjective($request);

        if (!$requisition) {
            throw new HttpResponseException(response()->json([
                'error' => "An error has ocurred during the requisition."
            ], 422));
        }

        return response()->json([
            'status' => true,
            'message' => "Objective created.",
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
        $requisition = $this->objectivesService->updateObjective($request, $id);

        if (!$requisition) {
            throw new HttpResponseException(response()->json([
                'error' => "An error has ocurred during the requisition."
            ], 422));
        }

        return response()->json([
            'status' => true,
            'message' => "Objective info updated.",
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $requisition = $this->objectivesService->deleteObjective($id);

        if (!$requisition) {
            throw new HttpResponseException(response()->json([
                'error' => "An error has ocurred during the requisition."
            ], 422));
        }

        return response()->json([
            'status' => true,
            'message' => "Objective deleted.",
        ], 200);
    }
}
