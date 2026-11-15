<?php

use App\Http\Controllers\AdminCrimeController;
use Illuminate\Support\Facades\Route;

Route::prefix('victoria-safe')->name('victoria-safe.')->group(function () {

    // Main Dashboard
    Route::get('/', [AdminCrimeController::class, 'dashboard'])->name('dashboard');

    // Crime Request Management
    Route::get('/crime-requests', [AdminCrimeController::class, 'crimeRequests'])->name('crime-requests');
    Route::post('/crime-requests/{crime}/approve', [AdminCrimeController::class, 'approve'])->name('crime-requests.approve');
    Route::post('/crime-requests/{crime}/reject', [AdminCrimeController::class, 'reject'])->name('crime-requests.reject');

    // Duplicate Review
    Route::get('/duplicate-review', [AdminCrimeController::class, 'duplicateReview'])->name('duplicate-review');

    // Approved Incidents
    Route::get('/approved-incidents', [AdminCrimeController::class, 'approvedIncidents'])->name('approved-incidents');

    // Crime Map Management
    Route::get('/crime-map', [AdminCrimeController::class, 'crimeMap'])->name('crime-map');

    // Analytics
    Route::get('/analytics', [AdminCrimeController::class, 'analytics'])->name('analytics');

});