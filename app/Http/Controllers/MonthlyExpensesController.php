<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Api\MonthlyExpenses\MonthlyExpensesService;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class MonthlyExpensesController extends Controller
{

    private $monthlyExpensesService;

    public function __construct(MonthlyExpensesService $monthlyExpensesService)
    {
        $this->monthlyExpensesService = $monthlyExpensesService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $requisition = $this->monthlyExpensesService->getExpenses($request);

        if (!$requisition) {
            throw new HttpResponseException(response()->json([
                'error' => "An error has ocurred during the requisition."
            ], 422));
        }

        return response()->json([
            'status'    => true,
            'message'   => "Monthly expense list.",
            'data'      => $requisition
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requisition = $this->monthlyExpensesService->storeExpense($request);

        if (!$requisition) {
            throw new HttpResponseException(response()->json([
                'error' => "An error has ocurred during the requisition."
            ], 422));
        }

        return response()->json([
            'status' => true,
            'message' => "Monthly expense created.",
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
        $requisition = $this->monthlyExpensesService->updateExpense($request, $id);

        if (!$requisition) {
            throw new HttpResponseException(response()->json([
                'error' => "An error has ocurred during the requisition."
            ], 422));
        }

        return response()->json([
            'status' => true,
            'message' => "Monthly expense info updated.",
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $requisition = $this->monthlyExpensesService->deleteExpense($id);

        if (!$requisition) {
            throw new HttpResponseException(response()->json([
                'error' => "An error has ocurred during the requisition."
            ], 422));
        }

        return response()->json([
            'status' => true,
            'message' => "Expense deleted.",
        ], 200);
    }
}
