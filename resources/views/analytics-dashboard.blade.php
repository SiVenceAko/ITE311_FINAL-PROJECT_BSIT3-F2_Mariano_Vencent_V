<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta
        name="description"
        content="View database-backed crime analytics, risk levels, incident trends, and area comparisons across Victoria City."
    >

    <title>Analytics Dashboard | Victoria City Crime Mapping System</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="analytics-dashboard-page">

    {{-- Header --}}
    <header class="site-header analytics-header">
        <div class="container navbar">

            <a href="{{ route('home') }}" class="brand" aria-label="Victoria Safe Home">
                <span class="brand-mark">
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true"
                    >
                        <path d="M12 3 5 6v5c0 4.6 2.8 8.1 7 10 4.2-1.9 7-5.4 7-10V6l-7-3Z"/>
                        <path d="m9.5 12 1.7 1.7 3.6-4"/>
                    </svg>
                </span>

                <span class="brand-text">
                    <span class="brand-name">Victoria Safe</span>
                    <span class="brand-subtitle">Crime Mapping System</span>
                </span>
            </a>

            <nav class="nav-links" aria-label="Primary navigation">
                <a href="{{ route('home') }}" class="nav-link">
                    Home
                </a>

                <a href="{{ route('crime-map') }}" class="nav-link">
                    Crime Map
                </a>

                <a href="{{ route('analytics-dashboard') }}" class="nav-link active">
                    Analytics
                </a>

                <a href="{{ route('crime-reports.create') }}" class="nav-link">
                    Report Incident
                </a>

                <a href="{{ route('home') }}#features" class="nav-link">
                    Features
                </a>
            </nav>

            <div class="nav-actions">
                <a href="{{ route('statamic.cp.victoria-safe.dashboard') }}" class="btn btn-secondary">
                    Login
                </a>

                <a href="{{ route('crime-map') }}" class="btn btn-primary">
                    Explore Map
                </a>
            </div>

            <button
                class="mobile-menu-button"
                type="button"
                aria-label="Open navigation menu"
            >
                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    aria-hidden="true"
                >
                    <path d="M4 7h16"/>
                    <path d="M4 12h16"/>
                    <path d="M4 17h16"/>
                </svg>
            </button>

        </div>
    </header>


    <main>

        {{-- Dashboard Hero --}}
        <section class="analytics-hero">
            <div class="container analytics-hero-content">

                <div>
                    <div class="hero-eyebrow">
                        <span class="hero-eyebrow-dot"></span>
                        {{ $analyticsContent?->hero_eyebrow ?? 'Crime Intelligence' }}
                    </div>

                    <h1 class="analytics-title">
                        {{ $analyticsContent?->hero_title ?? 'Crime Analytics' }}
                        <span>{{ $analyticsContent?->hero_title_span ?? 'Dashboard.' }}</span>
                    </h1>

                    <p class="analytics-description">
                        {{ $analyticsContent?->hero_description ?? 'Review crime patterns and area summaries calculated directly from records stored in the database.' }}
                    </p>
                </div>

                <div class="analytics-hero-status">
                    <span class="analytics-status-dot"></span>

                    <div>
                        <strong>{{ $analyticsContent?->hero_status_title ?? 'Database-backed analytics' }}</strong>
                        <span>{{ $analyticsContent?->hero_status_description ?? 'Statistics are computed from stored reports' }}</span>
                    </div>
                </div>

            </div>
        </section>


        {{-- Dashboard Content --}}
        <section class="analytics-content">
            <div class="container">

                {{-- Heading --}}
                <div class="analytics-heading">

                    <div>
                        <span class="section-eyebrow">
                            {{ $analyticsContent?->heading_eyebrow ?? 'Safety Overview' }}
                        </span>

                        <h2>{{ $analyticsContent?->heading_title ?? 'Victoria, Oriental Mindoro at a Glance' }}</h2>

                        <p>
                            {{ $analyticsContent?->heading_description ?? 'A summary of the incident records currently stored in the project database.' }}
                        </p>
                    </div>

                    <span class="analytics-period">
                        {{ $periodLabel }}
                    </span>

                </div>


                {{-- Summary Cards --}}
                <div class="analytics-summary-grid">

                    <article class="analytics-summary-card">
                        <div class="summary-card-top">
                            <span class="summary-icon total">
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    aria-hidden="true"
                                >
                                    <path d="M4 19V9"/>
                                    <path d="M10 19V5"/>
                                    <path d="M16 19v-7"/>
                                    <path d="M22 19H2"/>
                                </svg>
                            </span>

                            <span class="summary-label">
                                Total Records
                            </span>
                        </div>

                        <strong class="summary-value">{{ $totalCrimes }}</strong>

                        <p>
                            Total incident records in the database.
                        </p>
                    </article>


                    <article class="analytics-summary-card">
                        <div class="summary-card-top">
                            <span class="summary-icon high">
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    aria-hidden="true"
                                >
                                    <path d="M12 3 2.8 20h18.4L12 3Z"/>
                                    <path d="M12 9v4"/>
                                    <path d="M12 16h.01"/>
                                </svg>
                            </span>

                            <span class="summary-label">
                                High Risk
                            </span>
                        </div>

                        <strong class="summary-value">{{ $riskCounts['high'] }}</strong>

                        <p>
                            Records currently classified as high risk.
                        </p>
                    </article>


                    <article class="analytics-summary-card">
                        <div class="summary-card-top">
                            <span class="summary-icon moderate">
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    aria-hidden="true"
                                >
                                    <circle cx="12" cy="12" r="9"/>
                                    <path d="M12 7v5"/>
                                    <path d="M12 16h.01"/>
                                </svg>
                            </span>

                            <span class="summary-label">
                                Moderate Risk
                            </span>
                        </div>

                        <strong class="summary-value">{{ $riskCounts['moderate'] }}</strong>

                        <p>
                            Records currently categorized as moderate risk.
                        </p>
                    </article>


                    <article class="analytics-summary-card">
                        <div class="summary-card-top">
                            <span class="summary-icon monitored">
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    aria-hidden="true"
                                >
                                    <path d="M12 3 5 6v5c0 4.6 2.8 8.1 7 10 4.2-1.9 7-5.4 7-10V6l-7-3Z"/>
                                    <path d="m9.5 12 1.7 1.7 3.6-4"/>
                                </svg>
                            </span>

                            <span class="summary-label">
                                Monitored
                            </span>
                        </div>

                        <strong class="summary-value">{{ $riskCounts['monitored'] }}</strong>

                        <p>
                            Records currently classified as monitored.
                        </p>
                    </article>

                </div>


                {{-- Main Analytics Grid --}}
                <div class="analytics-main-grid">

                    {{-- Crime Type Distribution --}}
                    <article class="analytics-panel crime-distribution-panel">

                        <div class="analytics-panel-header">
                            <div>
                                <span class="panel-eyebrow">
                                    Crime Categories
                                </span>

                                <h3>Crime Type Distribution</h3>
                            </div>

                            <span class="panel-badge">
                                {{ $totalCrimes }} Records
                            </span>
                        </div>


                        <div class="distribution-list">

                            @forelse ($crimeTypeDistribution as $distribution)
                            <div class="distribution-item">
                                <div class="distribution-info">
                                    <span>
                                        <i class="distribution-dot theft"></i>
                                        {{ ucfirst($distribution['type']) }}
                                    </span>

                                    <strong>{{ $distribution['count'] }}</strong>
                                </div>

                                <div class="distribution-track">
                                    <span style="width: {{ $distribution['percentage'] }}%"></span>
                                </div>
                            </div>
                            @empty
                                <p>No crime records to summarize yet.</p>
                            @endforelse

                        </div>

                    </article>


                    {{-- Risk Overview --}}
                    <article class="analytics-panel risk-overview-panel">

                        <div class="analytics-panel-header">
                            <div>
                                <span class="panel-eyebrow">
                                    Risk Classification
                                </span>

                                <h3>Risk Level Overview</h3>
                            </div>
                        </div>


                        <div class="risk-visual">

                            <div
                                class="risk-donut"
                                style="background: conic-gradient(var(--color-danger) 0% {{ $riskPercentages['high'] }}%, var(--color-warning) {{ $riskPercentages['high'] }}% {{ $riskPercentages['high'] + $riskPercentages['moderate'] }}%, var(--color-primary-500) {{ $riskPercentages['high'] + $riskPercentages['moderate'] }}% 100%)"
                            >
                                <div class="risk-donut-center">
                                    <strong>{{ $totalCrimes }}</strong>
                                    <span>Incidents</span>
                                </div>
                            </div>


                            <div class="risk-legend">

                                <div>
                                    <span>
                                        <i class="risk-dot high"></i>
                                        High Risk
                                    </span>

                                    <strong>{{ $riskCounts['high'] }}</strong>
                                </div>

                                <div>
                                    <span>
                                        <i class="risk-dot moderate"></i>
                                        Moderate
                                    </span>

                                    <strong>{{ $riskCounts['moderate'] }}</strong>
                                </div>

                                <div>
                                    <span>
                                        <i class="risk-dot monitored"></i>
                                        Monitored
                                    </span>

                                    <strong>{{ $riskCounts['monitored'] }}</strong>
                                </div>

                            </div>

                        </div>

                    </article>


                    {{-- Incident Trend --}}
                    <article class="analytics-panel incident-trend-panel">

                        <div class="analytics-panel-header">
                            <div>
                                <span class="panel-eyebrow">
                                    Incident Activity
                                </span>

                                <h3>Incident Trend</h3>
                            </div>

                            <span class="panel-badge">
                                {{ $periodLabel }}
                            </span>
                        </div>


                        <div class="trend-chart">

                            <div class="trend-y-axis">
                                <span>{{ $maxDailyCount }}</span>
                                <span>{{ max(1, (int) ceil($maxDailyCount / 2)) }}</span>
                                <span>1</span>
                                <span>0</span>
                            </div>

                            <div class="trend-chart-area">

                                <div class="trend-grid-lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>

                                <div class="trend-bars">
                                    @forelse ($dailyTrend as $day)
                                        <div class="trend-bar-group">
                                            <span
                                                class="trend-bar"
                                                style="height: {{ max(8, $day['count'] / $maxDailyCount * 100) }}%"
                                                title="{{ $day['count'] }} incidents"
                                            ></span>
                                            <small>{{ $day['date'] }}</small>
                                        </div>
                                    @empty
                                        <p>No dated incident records to chart.</p>
                                    @endforelse
                                </div>

                            </div>

                        </div>

                    </article>


                    {{-- Area Comparison --}}
                    <article class="analytics-panel area-comparison-panel">

                        <div class="analytics-panel-header">
                            <div>
                                <span class="panel-eyebrow">
                                    Location Summary
                                </span>

                                <h3>Area Comparison</h3>
                            </div>
                        </div>


                        <div class="area-comparison-list">

                            @forelse ($areaComparison as $area)
                                <div class="area-comparison-item">
                                    <span class="area-rank">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>

                                    <div class="area-comparison-copy">
                                        <strong>{{ $area['name'] }}</strong>
                                        <span>{{ $area['count'] }} {{ $area['count'] === 1 ? 'incident' : 'incidents' }}</span>
                                    </div>

                                    <span class="area-risk {{ $area['risk_level'] }}">
                                        {{ $area['risk_level'] === 'high' ? 'High Risk' : ucfirst($area['risk_level']) }}
                                    </span>
                                </div>
                            @empty
                                <p>No barangay records to compare yet.</p>
                            @endforelse

                        </div>

                    </article>

                </div>

            </div>
        </section>


        {{-- Development Notice --}}
        <section class="analytics-notice">
            <div class="container">

                <div class="analytics-notice-inner">

                    <div class="analytics-notice-icon">
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            aria-hidden="true"
                        >
                            <circle cx="12" cy="12" r="9"/>
                            <path d="M12 11v5"/>
                            <path d="M12 8h.01"/>
                        </svg>
                    </div>

                    <div>
                        <span>Data Notice</span>

                        <h2>
                            {{ $analyticsContent?->notice_title ?? 'Analytics are calculated from stored database records.' }}
                        </h2>

                        <p>
                            {{ $analyticsContent?->notice_description ?? 'Confirm reports with official sources. This dashboard summarizes stored information and does not verify it.' }}
                        </p>
                    </div>

                    <a
                        href="{{ route('crime-map') }}"
                        class="btn btn-primary"
                    >
                        Explore Crime Map
                    </a>

                </div>

            </div>
        </section>

    </main>


    {{-- Footer --}}
    <footer class="site-footer">
        <div class="container footer-content">

            <p>
                &copy; {{ date('Y') }} Victoria City Crime Mapping System
            </p>

            <div class="footer-status">
                <span class="footer-status-dot"></span>
                {{ $analyticsContent?->footer_status ?? 'Database-backed analytics' }}
            </div>

        </div>
    </footer>

</body>
</html>
