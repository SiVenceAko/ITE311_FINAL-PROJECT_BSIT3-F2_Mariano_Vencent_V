
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @cascade(['homepage' => null])

    @php
        $homepageContent = $homepage ?? null;

        $heroTitle = $homepageContent?->hero_title
            ?? 'Know Your City. Understand Your Safety.';

        $heroTitleParts = preg_split('/(?<=\.)\s+/', trim($heroTitle), 2);
    @endphp

    <meta
        name="description"
        content="{{ $homepageContent?->hero_description ?? 'Victoria City Crime Mapping System - Explore crime incidents, safety trends, and high-risk areas across Victoria City.' }}"
    >

    <title>Victoria City Crime Mapping System</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

<header class="site-header">
    <div class="container navbar">

        <a href="{{ route('home') }}" class="brand" aria-label="Victoria City Crime Mapping System home">
            <span class="brand-mark">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M12 3 5 6v5c0 4.6 2.9 8.2 7 10 4.1-1.8 7-5.4 7-10V6l-7-3Z"/>
                    <path d="M9 12l2 2 4-4"/>
                </svg>
            </span>

            <span class="brand-text">
                <span class="brand-name">Victoria Safe</span>
                <span class="brand-subtitle">Crime Mapping System</span>
            </span>
        </a>

        <nav class="nav-links" aria-label="Primary navigation">
            <a href="{{ route('home') }}" class="nav-link active">Home</a>
            <a href="{{ route('crime-map') }}" class="nav-link">Crime Map</a>
            <a href="{{ route('analytics-dashboard') }}" class="nav-link">Analytics</a>
            <a href="{{ route('crime-reports.create') }}" class="nav-link">Report Incident</a>
            <a href="#features" class="nav-link">Features</a>
        </nav>

        <div class="nav-actions">
            <a href="{{ route('statamic.cp.victoria-safe.dashboard') }}" class="btn btn-secondary">
                Login
            </a>

            <a href="{{ route('crime-map') }}" class="btn btn-primary">
                Explore Map

                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="m9 18 6-6-6-6"/>
                </svg>
            </a>
        </div>

        <button
            class="mobile-menu-button"
            type="button"
            aria-label="Open navigation menu"
        >
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M4 7h16M4 12h16M4 17h16"/>
            </svg>
        </button>

    </div>
</header>


<main>

    <section class="home-hero">

        <div class="container hero-grid">

            <div class="hero-content">

                <div class="hero-eyebrow">
                    <span class="hero-eyebrow-dot"></span>
                    {{ $homepageContent?->hero_eyebrow ?? 'VICTORIA CITY PUBLIC SAFETY' }}
                </div>

                <h1 class="hero-title">
                    {{ $heroTitleParts[0] ?? $heroTitle }}

                    @if (!empty($heroTitleParts[1]))
                        <span>{{ $heroTitleParts[1] }}</span>
                    @endif
                </h1>

                <p class="hero-description">
                    {{ $homepageContent?->hero_description ?? 'Explore reported crime incidents, identify high-risk areas, and understand neighborhood safety trends through an accessible visual crime mapping platform for Victoria City.' }}
                </p>

                <div class="hero-actions">

                    <a href="{{ route('crime-map') }}" class="btn btn-primary">
                        {{ $homepageContent?->primary_button_label ?? 'Explore Crime Map' }}

                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 12h14M13 6l6 6-6 6"/>
                        </svg>
                    </a>

                    <a href="#overview" class="btn btn-secondary">
                        {{ $homepageContent?->secondary_button_label ?? 'View Safety Overview' }}
                    </a>

                </div>

                <div class="hero-note">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M12 3 5 6v5c0 4.6 2.9 8.2 7 10 4.1-1.8 7-5.4 7-10V6l-7-3Z"/>
                    </svg>

Approved incident data is shown from the latest records.
                </div>

            </div>


            <div class="map-preview home-hero-map" id="home-hero-map" aria-label="Victoria City crime map">

                <div class="map-preview-top">
                    <span class="map-preview-label">
                        Victoria City
                    </span>

                    <span class="map-live">
                        Live Map
                    </span>
                </div>

                <div class="map-legend">
                    <span class="legend-item">
                        <span class="legend-dot low"></span>
                        Monitored
                    </span>

                    <span class="legend-item">
                        <span class="legend-dot medium"></span>
                        Moderate Risk
                    </span>

                    <span class="legend-item">
                        <span class="legend-dot high"></span>
                        High Risk
                    </span>
                </div>

            </div>

            @php
                $homeMapCrimes = ($crimes ?? collect())->map(function ($crime) {
                    return [
                        'id' => $crime->id,
                        'type' => $crime->type,
                        'location' => $crime->barangay?->name,
                        'latitude' => $crime->latitude,
                        'longitude' => $crime->longitude,
                        'risk' => in_array($crime->risk_level, ['high', 'moderate', 'monitored'], true) ? $crime->risk_level : 'monitored',
                    ];
                })->values();
            @endphp
            <script type="application/json" id="home-crimes-data">{!! $homeMapCrimes->toJson(JSON_UNESCAPED_UNICODE) !!}</script>

        </div>

    </section>


    <section class="overview-section" id="overview">

        <div class="container">

            <div class="overview-panel">

                @php
                    $homeCrimes = $crimes ?? collect();
                    $homeTotalCrimes = $homeCrimes->count();
                    $homeThisMonth = $homeCrimes->filter(fn ($c) => $c->date && $c->date->isCurrentMonth())->count();
                    $homeHighRiskAreas = $homeCrimes->where('risk_level', 'high')->pluck('barangay_id')->filter()->unique()->count();
                    $homeMonitoredAreas = $homeCrimes->pluck('barangay_id')->filter()->unique()->count();
                @endphp

                <div class="overview-grid">

                    <article class="stat-card">
                        <p class="stat-label">Total Reports</p>
                        <p class="stat-value">{{ $homeTotalCrimes }}</p>
                        <p class="stat-meta">Approved incident records</p>
                    </article>

                    <article class="stat-card">
                        <p class="stat-label">Reports This Month</p>
                        <p class="stat-value">{{ $homeThisMonth }}</p>
                        <p class="stat-meta">Approved incidents this month</p>
                    </article>

                    <article class="stat-card alert">
                        <p class="stat-label">High-Risk Areas</p>
                        <p class="stat-value">{{ $homeHighRiskAreas }}</p>
                        <p class="stat-meta">Areas identified for monitoring</p>
                    </article>

                    <article class="stat-card safe">
                        <p class="stat-label">Areas Monitored</p>
                        <p class="stat-value">{{ $homeMonitoredAreas }}</p>
                        <p class="stat-meta">Areas included in monitoring</p>
                    </article>

                </div>

            </div>

        </div>

    </section>


    <section class="section features-section" id="features">

        <div class="container">

            <div class="features-header">

                <div class="section-heading">

                    <span class="section-eyebrow">
                        Public Safety Tools
                    </span>

                    <h2 class="section-title">
                        Understand safety through clear visual information.
                    </h2>

                    <p class="section-description">
                        Designed to make crime information easier to explore,
                        compare, and understand across Victoria City.
                    </p>

                </div>

            </div>


            <div class="features-grid">

                <article class="feature-card">

                    <div class="feature-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="m3 6 6-3 6 3 6-3v15l-6 3-6-3-6 3V6Z"/>
                            <path d="M9 3v15M15 6v15"/>
                        </svg>
                    </div>

                    <h3>Interactive Crime Map</h3>

                    <p>
                        Explore reported incidents geographically and understand
                        where activity occurs across the city.
                    </p>

                </article>


                <article class="feature-card">

                    <div class="feature-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <circle cx="12" cy="12" r="3"/>
                            <circle cx="12" cy="12" r="7"/>
                            <circle cx="12" cy="12" r="10"/>
                        </svg>
                    </div>

                    <h3>Crime Heatmaps</h3>

                    <p>
                        Identify areas with higher concentrations of reported
                        incidents through easy-to-read visual heatmaps.
                    </p>

                </article>


                <article class="feature-card">

                    <div class="feature-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M4 19V5"/>
                            <path d="M4 19h16"/>
                            <path d="m7 15 4-4 3 2 5-6"/>
                        </svg>
                    </div>

                    <h3>Safety Trends</h3>

                    <p>
                        Review patterns by date, crime type, and location to
                        better understand neighborhood safety trends.
                    </p>

                </article>

            </div>

        </div>

    </section>


    <section class="safety-banner">

        <div class="container">

            <div class="safety-banner-inner">

                <div class="safety-banner-content">

                    <span class="section-eyebrow">
                        Built for Awareness
                    </span>

                    <h2>
                        {{ $homepageContent?->safety_banner_title ?? 'Better information helps communities make more informed decisions.' }}
                    </h2>

                    <p>
                        {{ $homepageContent?->safety_banner_description ?? 'The Victoria City Crime Mapping System presents public safety information through maps, filters, heatmaps, and visual analytics in one accessible platform.' }}
                    </p>

                </div>

                <div class="safety-banner-side">

                    <div class="safety-shield">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M12 3 5 6v5c0 4.6 2.9 8.2 7 10 4.1-1.8 7-5.4 7-10V6l-7-3Z"/>
                            <path d="M9 12l2 2 4-4"/>
                        </svg>
                    </div>

                </div>

            </div>

        </div>

    </section>

</main>


<footer class="site-footer">

    <div class="container footer-content">

        <p>
            &copy; {{ date('Y') }} Victoria City Crime Mapping System
        </p>

        <div class="footer-status">
            <span class="footer-status-dot"></span>
            {{ $homepageContent?->footer_status ?? 'Front-end demonstration' }}
        </div>

    </div>

</footer>

</body>
</html>
