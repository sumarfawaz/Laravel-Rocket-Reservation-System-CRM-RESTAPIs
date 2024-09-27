<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/customers', [CustomerController::class, 'index']);
Route::get('/customers/{epassportid}', [CustomerController::class, 'show']);
Route::post('/customers', [CustomerController::class, 'store']);
Route::put('/customers/{epassportid}', [CustomerController::class, 'update']);
Route::delete('/customers/{epassportid}', [CustomerController::class, 'destroy']);
