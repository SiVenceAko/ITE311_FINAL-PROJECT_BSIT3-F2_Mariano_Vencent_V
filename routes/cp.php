
<?php

use Illuminate\Support\Facades\Route;

Route::prefix('victoria-safe')->name('victoria-safe.')->group(function () {

    // Main Dashboard
    Route::get('/', function () {
        return view('cp.victoria-safe.dashboard');
    })->name('dashboard');

    // Crime Request Management
    Route::get('/crime-requests', function () {
        return view('cp.victoria-safe.pages.crime-requests');
    })->name('crime-requests');

    // Duplicate Review
    Route::get('/duplicate-review', function () {
        return view('cp.victoria-safe.pages.duplicate-review');
    })->name('duplicate-review');

    // Approved Incidents
    Route::get('/approved-incidents', function () {
        return view('cp.victoria-safe.pages.approved-incidents');
    })->name('approved-incidents');

    // Crime Map Management
    Route::get('/crime-map', function () {
        return view('cp.victoria-safe.pages.crime-map');
    })->name('crime-map');

    // Analytics
    Route::get('/analytics', function () {
        return view('cp.victoria-safe.pages.analytics');
    })->name('analytics');

});
