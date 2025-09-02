<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorsCollection;
use App\Models\Authors;
use App\Services\Api\Authors\AuthorsService;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{

    private $authorsService;

    public function __construct(AuthorsService $authorsService)
    {
        $this->authorsService = $authorsService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $requisition = Authors::get();

        if (!$requisition) {
            throw new HttpResponseException(response()->json([
                'error' => "An error has ocurred during the requisition."
            ], 422));
        }

        return response()->json([
            'status'    => true,
            'message'   => "Autor list.",
            'data'      => new AuthorsCollection($requisition)
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requisition = $this->authorsService->storeAuthor($request);

        if (!$requisition) {
            throw new HttpResponseException(response()->json([
                'error' => "An error has ocurred during the requisition."
            ], 422));
        }

        return response()->json([
            'status' => true,
            'message' => "Author added.",
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, int $id)
    {
        $requisition = Authors::where('id', $id)->first();

        if (!$requisition) {
            throw new HttpResponseException(response()->json([
                'error' => "An error has ocurred during the requisition."
            ], 422));
        }

        return response()->json([
            'status'    => true,
            'message'   => "Autor data.",
            'data'      => $requisition
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $requisition = $this->authorsService->updateAuthor($request, $id);

        if (!$requisition) {
            throw new HttpResponseException(response()->json([
                'error' => "An error has ocurred during the requisition."
            ], 422));
        }

        return response()->json([
            'status' => true,
            'message' => "Author info updated.",
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $requisition = $this->authorsService->deleteAuthor($id);

        if (!$requisition) {
            throw new HttpResponseException(response()->json([
                'error' => "An error has ocurred during the requisition."
            ], 422));
        }

        return response()->json([
            'status' => true,
            'message' => "Book deleted.",
        ], 200);
    }
}
