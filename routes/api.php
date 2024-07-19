<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function(){
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::get('/client', [ClientController::class, 'index']);
Route::post('/client', [ClientController::class, 'create']);
Route::put('/client/{id}', [ClientController::class, 'update']);
Route::delete('/client/{id}', [ClientController::class, 'delete']);
Route::get('/client/{id}', [ClientController::class, 'getById']);
Route::get('/client/consultafinal-placa/{numero}', [ClientController::class, 'getByLastCarPlateDigit']);