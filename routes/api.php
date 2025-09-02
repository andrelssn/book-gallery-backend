<?php

use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\UserInfoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::prefix('auth')->group(function(){
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::prefix('user')->middleware('auth:sanctum')->group(function() {
    Route::get('/', function (Request $request) {
        return $request->user();
    });

    Route::put('/value/{id}', [UserInfoController::class, 'updateValue']);
    Route::put('/name/{id}', [UserInfoController::class, 'updateName']);
});

Route::prefix('books')->group(function() {
    Route::get('', [BooksController::class, 'index']);
    Route::post('', [BooksController::class, 'store']);
    Route::put('{id}', [BooksController::class, 'update']);
    Route::delete('{id}', [BooksController::class, 'destroy']);
});

Route::prefix('authors')->group(function() {
    Route::get('', [AuthorsController::class, 'index']);
    Route::get('/books/{id}', [AuthorsController::class, 'books']);
    Route::post('', [AuthorsController::class, 'store']);
    Route::put('{id}', [AuthorsController::class, 'update']);
    Route::delete('{id}', [AuthorsController::class, 'destroy']);
});

Route::get('/web', function () {
    return 'welcome';
});
