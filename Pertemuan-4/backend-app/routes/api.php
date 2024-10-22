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

Route::get('/index', [AnimalsController::class, 'index']);
Route::post('/store', [AnimalsController::class, 'store']);
Route::put('/update/{id}', [AnimalsController::class, 'update']);
Route::delete('/delete/{id}', [AnimalsController::class, 'delete']);
