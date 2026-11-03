
<?php

use Illuminate\Support\Facades\Route;
use Statamic\Facades\GlobalSet;

Route::get('/', function () {
    $homepage = GlobalSet::findByHandle('homepage')
        ?->inDefaultSite();

    return view('home', [
        'homepage' => $homepage,
    ]);
})->name('home');

Route::get('/crime-map', function () {
    return view('crime-map');
})->name('crime-map');

Route::get('/analytics', function () {
    return view('analytics-dashboard');
})->name('analytics-dashboard');
