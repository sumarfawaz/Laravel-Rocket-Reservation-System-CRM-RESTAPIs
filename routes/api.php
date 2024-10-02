<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RocketController;
use App\Http\Controllers\SpaceStationController;
use App\Http\Controllers\SchedulerController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AnalyticsController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Customers API
Route::get('/customers', [CustomerController::class, 'index']);
Route::get('/customers/{epassportid}', [CustomerController::class, 'show']);
Route::post('/customers', [CustomerController::class, 'store']);
Route::put('/customers/{epassportid}', [CustomerController::class, 'update']);
Route::delete('/customers/{epassportid}', [CustomerController::class, 'destroy']);

//Rockets API
Route::get('/rockets', [RocketController::class,'index']);
Route::get('/rockets/{rocketname}', [RocketController::class, 'show']);
Route::post('/rockets', [RocketController::class, 'store']);
Route::put('/rockets/{rocketname}', [RocketController::class, 'update']);
Route::delete('/rockets/{rocketname}', [RocketController::class, 'destroy']);


//SpaceStations API
Route::get('/spacestations', [SpaceStationController::class, 'index']);
Route::get('/spacestations/{spacestation_name}', [SpaceStationController::class, 'show']);
Route::post('/spacestations', [SpaceStationController::class, 'store']);
Route::put('/spacestations/{spacestation_name}', [SpaceStationController::class, 'update']);
Route::delete('/spacestations/{spacestation_name}', [SpaceStationController::class, 'destroy']);


//Scheduler APIs
Route::get('/schedules', [SchedulerController::class, 'index']);
Route::get('/schedules/{scheduler_name}', [SchedulerController::class, 'show']);
Route::post('/schedules', [SchedulerController::class, 'store']);
Route::put('/schedules/{scheduler_name}', [SchedulerController::class, 'update']);
Route::delete('/schedules/{scheduler_name}', [SchedulerController::class, 'destroy']);


//Tickets APIs
Route::get('/tickets', [TicketController::class, 'index']);
Route::get('/tickets/{id}', [TicketController::class, 'show']);
Route::post('/tickets', [TicketController::class, 'store']);
Route::put('/tickets/{id}', [TicketController::class, 'update']);
Route::delete('/tickets/{id}', [TicketController::class, 'destroy']);


//Analytics APIs for Dashboards
Route::get('/analytics/customers', [AnalyticsController::class, 'getCustomerAnalytics']);
