<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/crime-map', function () {
    return view('crime-map');
})->name('crime-map');
