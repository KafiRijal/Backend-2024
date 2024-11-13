<?php

use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rute untuk mengelola data pegawai
Route::get('/employees', [PegawaiController::class, 'index'])->middleware('auth:sanctum');
Route::post('/employees', [PegawaiController::class, 'store'])->middleware('auth:sanctum');
Route::get('/employees/{id}', [PegawaiController::class, 'show'])->middleware('auth:sanctum');
Route::put('/employees/{id}', [PegawaiController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/employees/{id}', [PegawaiController::class, 'destroy'])->middleware('auth:sanctum');

// Rute untuk pencarian data pegawai
Route::get('/employees/search/{name}', [PegawaiController::class, 'search'])->middleware('auth:sanctum');
Route::get('/employees/status/active', [PegawaiController::class, 'active'])->middleware('auth:sanctum');
Route::get('/employees/status/inactive', [PegawaiController::class, 'inactive'])->middleware('auth:sanctum');
Route::get('/employees/status/terminated', [PegawaiController::class, 'terminated'])->middleware('auth:sanctum');

// Rute untuk registrasi dan login
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
