<?php

use App\Http\Controllers\Admin\ChirpController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin.access', 'check.active'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // User Management
    Route::controller(UserController::class)->prefix('users')->name('users.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{user}', 'show')->name('show');
        Route::patch('/{user}/toggle-status', 'toggleStatus')->name('toggle-status');
        Route::delete('/{user}', 'destroy')->name('destroy');
        Route::post('/{user}/assign-role', 'assignRole')->name('assign-role');
    });

    // Chirp Management
    Route::controller(ChirpController::class)->prefix('chirps')->name('chirps.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{chirp}', 'show')->name('show');
        Route::delete('/{chirp}', 'destroy')->name('destroy');
        Route::patch('/{chirp}/toggle-review', 'toggleReview')->name('toggle-review');
    });

    // Report Management
    Route::controller(ReportController::class)->prefix('reports')->name('reports.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{report}', 'show')->name('show');
        Route::patch('/{report}', 'update')->name('update');
        Route::delete('/{report}', 'destroy')->name('destroy');
    });
});
