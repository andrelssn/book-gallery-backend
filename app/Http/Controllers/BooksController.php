<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\BooksCollection;
use App\Models\Books;
use App\Services\Api\Books\BooksService;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class BooksController extends Controller
{

    private $booksService;

    public function __construct(BooksService $booksService)
    {
        $this->booksService = $booksService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $requisition = Books::get();

        if (!$requisition) {
            throw new HttpResponseException(response()->json([
                'error' => "An error has ocurred during the requisition."
            ], 422));
        }

        return response()->json([
            'status'    => true,
            'message'   => "Book list.",
            'data'      => new BooksCollection($requisition)
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requisition = $this->booksService->storeBook($request);

        if (!$requisition) {
            throw new HttpResponseException(response()->json([
                'error' => "An error has ocurred during the requisition."
            ], 422));
        }

        return response()->json([
            'status' => true,
            'message' => "Livro added.",
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
        $requisition = $this->booksService->updateBook($request, $id);

        if (!$requisition) {
            throw new HttpResponseException(response()->json([
                'error' => "An error has ocurred during the requisition."
            ], 422));
        }

        return response()->json([
            'status' => true,
            'message' => $requisition,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $requisition = $this->booksService->deleteBook($id);

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
