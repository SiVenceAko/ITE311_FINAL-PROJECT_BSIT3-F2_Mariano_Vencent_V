
<?php

use App\Http\Controllers\CrimeDashboardController;
use App\Http\Controllers\CrimeReportController;
use Illuminate\Support\Facades\Route;
use Statamic\Facades\GlobalSet;

Route::get('/', function () {
    $homepage = GlobalSet::findByHandle('homepage')
        ?->inDefaultSite();

    $crimes = \App\Models\Crime::query()
        ->where('status', 'approved')
        ->with('barangay')
        ->orderByDesc('date')
        ->orderByDesc('id')
        ->get();

    return view('home', [
        'homepage' => $homepage,
        'crimes' => $crimes,
    ]);
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
