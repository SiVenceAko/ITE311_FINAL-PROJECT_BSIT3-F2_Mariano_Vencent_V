<?php

use App\Http\Controllers\CrimeDashboardController;
use App\Http\Controllers\CrimeReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/crime-map', [CrimeDashboardController::class, 'map'])
    ->name('crime-map');

Route::get('/analytics', [CrimeDashboardController::class, 'analytics'])
    ->name('analytics-dashboard');

Route::get('/report-crime', [CrimeReportController::class, 'create'])
    ->name('crime-reports.create');
Route::post('/report-crime', [CrimeReportController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('crime-reports.store');
