<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Statamic\Facades\CP\Nav;
use Statamic\Statamic;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Statamic::pushCpRoutes(function () {
            Route::namespace('\App\Http\Controllers')->group(function () {
                require base_path('routes/cp.php');
            });
        });

        Nav::extend(function ($nav) {
            $nav->create('Dashboard')
                ->section('Victoria Safe')
                ->route('victoria-safe.dashboard');

            $nav->create('Crime Requests')
                ->section('Victoria Safe')
                ->route('victoria-safe.crime-requests');

            $nav->create('Duplicate Review')
                ->section('Victoria Safe')
                ->route('victoria-safe.duplicate-review');

            $nav->create('Approved Incidents')
                ->section('Victoria Safe')
                ->route('victoria-safe.approved-incidents');

            $nav->create('Crime Map')
                ->section('Victoria Safe')
                ->route('victoria-safe.crime-map');

            $nav->create('Analytics')
                ->section('Victoria Safe')
                ->route('victoria-safe.analytics');
        });
    }
}
