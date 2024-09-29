<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AnalyticsController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    
    Route::get('/dashboard', function () {
        $title = 'RocketX - Dashboard';
        return view('dashboard',compact('title'));
    })->name('dashboard');
});

Route::get('/analytics/customers', [AnalyticsController::class, 'getCustomerAnalyticsByNationality']);


Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
