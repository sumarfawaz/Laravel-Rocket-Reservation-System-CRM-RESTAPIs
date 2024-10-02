<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AnalyticsController;

Route::get('/', function () {
    return view('welcome');
});

// Routes requiring authentication and verification
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    // Dashboard Route
    Route::get('/dashboard', function () {
        $title = 'RocketX - Dashboard';
        return view('dashboard', compact('title'));
    })->name('dashboard');

    // Management Routes
    Route::get('/manage-users', function () {
        $title = 'RocketX - Customers';
        return view('manage-users', compact('title'));
    })->name('manage-users');

    Route::get('/manage-rockets', function () {
        $title = 'RocketX - Rockets';
        return view('manage-rockets', compact('title'));
    })->name('manage-rockets');

    Route::get('/manage-space-stations', function () {
        $title = 'RocketX - Space Stations';
        return view('manage-space-stations', compact('title'));
    })->name('manage-space-stations');

    Route::get('/view-sales', function () {
        $title = 'RocketX - Tickets';
        return view('view-sales', compact('title'));
    })->name('view-sales');

});

// Analytics Routes
Route::prefix('analytics')->group(function () {
    Route::get('/customers', [AnalyticsController::class, 'getCustomerAnalyticsByNationality']);
    Route::get('/total-customers', [AnalyticsController::class, 'getCustomerCount']);
    Route::get('/total_rockets', [AnalyticsController::class, 'getRocketCount']);
    Route::get('/total_sales', [AnalyticsController::class, 'getTotalSales']);
    Route::get('/total_space_stations', [AnalyticsController::class, 'getSpaceStationCount']);
    Route::get('/tickets-by-date', [AnalyticsController::class, 'getTicketsByCreationDate']);

});

// Customer Routes
Route::prefix('customers')->group(function () {
    Route::get('/', [CustomerController::class, 'index'])->name('customers.index');
    Route::post('/', [CustomerController::class, 'store'])->name('customers.store');
    Route::get('/{epassportid}', [CustomerController::class, 'show'])->name('customers.show');
    Route::put('/{epassportid}', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/{epassportid}', [CustomerController::class, 'destroy'])->name('customers.destroy');
});

// Logout Route
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
