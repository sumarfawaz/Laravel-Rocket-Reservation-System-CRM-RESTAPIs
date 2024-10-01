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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    
    Route::get('/manage-users', function () {
        $title = 'RocketX - Customers';
        return view('manage-users',compact('title'));
    })->name('manage-users');
});


// Route::get('/manage-users', [CustomerController::class, 'index'])
//     ->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])
//     ->name('manage-users');



//Analytics Routes
Route::get('/analytics/customers', [AnalyticsController::class, 'getCustomerAnalyticsByNationality']);
Route::get('/analytics/total-customers', [AnalyticsController::class, 'getCustomerCount']);

//Rocket Routes
Route::get('/analytics/total_rockets', [AnalyticsController::class, 'getRocketCount']);

//Sales Routes
Route::get('/analytics/total_sales', [AnalyticsController::class, 'getTotalSales']);

//Space Station Routes
Route::get('/analytics/total_space_stations', [AnalyticsController::class, 'getSpaceStationCount']);

//Customer Routes
Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
// Add the destroy route
Route::delete('/customers/{epassportid}', [CustomerController::class, 'destroy'])->name('customers.destroy');
// Add the show route
Route::get('/customers/{epassportid}', [CustomerController::class, 'show'])->name('customers.show');
// Add the store route
Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
// Add the update route
Route::put('/customers/{epassportid}', [CustomerController::class, 'update'])->name('customers.update');


Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
