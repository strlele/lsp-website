<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubKategoriController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Category Jurusan + endpoint mengambil kategori (subcategory) per category
Route::apiResource('categories', CategoryController::class);
Route::get('categories/{category}/kategoris', [CategoryController::class, 'kategoris']);

// Subkategori endpoint: ambil subkategori berdasarkan kategori (kategoris table)
Route::get('kategoris/{kategori}/subkategoris', [SubKategoriController::class, 'getByKategori']);
