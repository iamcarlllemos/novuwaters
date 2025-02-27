<?php

use App\Http\Controllers\AccountOverviewController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyTypesController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WaterRatesController;
use App\Http\Controllers\WaterReadingController;
use App\Models\WaterReading;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->to('/login');
});

Auth::routes();

Route::any('/logut', [LoginController::class, 'logout']);

Route::middleware('auth')->group(function() {

    Route::prefix('my')->group(function() {
        Route::get('overview', [AccountOverviewController::class, 'index'])
            ->name('account-overview.index');
        Route::get('bills', [AccountOverviewController::class, 'show'])
            ->name('account-overview.show');
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('water-reading', [WaterReadingController::class, 'index'])
        ->name('water-reading.index');

    Route::post('water-reading', [WaterReadingController::class, 'store'])
        ->name('water-reading.store');

    Route::get('water-reading/bill/{reference_no}', [WaterReadingController::class, 'show'])
        ->name('water-reading.show');

    Route::get('water-reading/reports/{date?}', [WaterReadingController::class, 'report'])
        ->name('water-reading.report');

    Route::prefix('users')->group(function() {

        Route::resource('roles', RoleController::class)
            ->names('roles');

        Route::resource('clients', ClientController::class)
            ->names('clients');

        Route::resource('personnel', UserController::class)
            ->names('users');
    });

    Route::prefix('settings')->group(function() {
        Route::resource('property-types', PropertyTypesController::class)
            ->names('property-types');

        Route::resource('water-rates', WaterRatesController::class)
            ->names('water-rates');
    });

    Route::resource('profile', ProfileController::class)
        ->names('profile');

    Route::get('/transactions', [ClientController::class, 'index'])
        ->name('transactions');

    Route::get('/reports', [ClientController::class, 'index'])
        ->name('reports');
});