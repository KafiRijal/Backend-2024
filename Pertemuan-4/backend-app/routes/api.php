<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalsController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Contoh routing yang dapat diakses oleh postman
// Route::get('/animals', function (){
//     echo "Menampilkan data animals";
// });

Route::get('/animals', [AnimalsController::class, 'index']);
Route::post('/animals', [AnimalsController::class, 'store']);
Route::put('/animals/{id}', [AnimalsController::class, 'update']);
Route::delete('/animals/{id}', [AnimalsController::class, 'delete']);
