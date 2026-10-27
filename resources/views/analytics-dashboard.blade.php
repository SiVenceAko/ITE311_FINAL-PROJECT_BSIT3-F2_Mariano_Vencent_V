<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta
        name="description"
        content="View sample crime analytics, risk levels, incident trends, and area comparisons across Victoria City."
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

                <a href="{{ route('home') }}#features" class="nav-link">
                    Features
                </a>
            </nav>

            <div class="nav-actions">
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
                        Crime Intelligence
                    </div>

                    <h1 class="analytics-title">
                        Crime Analytics
                        <span>Dashboard.</span>
                    </h1>

                    <p class="analytics-description">
                        Review sample crime patterns, compare monitored areas,
                        and explore visual safety indicators through a clear
                        analytics interface.
                    </p>
                </div>

                <div class="analytics-hero-status">
                    <span class="analytics-status-dot"></span>

                    <div>
                        <strong>Sample analytics</strong>
                        <span>Front-end demonstration data</span>
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
                            Safety Overview
                        </span>

                        <h2>Victoria City at a Glance</h2>

                        <p>
                            A summary of sample incident records currently
                            represented in the front-end demonstration.
                        </p>
                    </div>

                    <span class="analytics-period">
                        Sample Period · October 2026
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
                                Sample Records
                            </span>
                        </div>

                        <strong class="summary-value">3</strong>

                        <p>
                            Total incidents represented in the current
                            demonstration dataset.
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

                        <strong class="summary-value">1</strong>

                        <p>
                            One sample incident is currently classified
                            as high risk.
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

                        <strong class="summary-value">1</strong>

                        <p>
                            One sample incident is categorized under
                            moderate risk.
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

                        <strong class="summary-value">1</strong>

                        <p>
                            One sample incident is represented as a
                            monitored risk level.
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
                                3 Records
                            </span>
                        </div>


                        <div class="distribution-list">

                            <div class="distribution-item">
                                <div class="distribution-info">
                                    <span>
                                        <i class="distribution-dot theft"></i>
                                        Theft
                                    </span>

                                    <strong>1</strong>
                                </div>

                                <div class="distribution-track">
                                    <span style="width: 33.33%"></span>
                                </div>
                            </div>


                            <div class="distribution-item">
                                <div class="distribution-info">
                                    <span>
                                        <i class="distribution-dot robbery"></i>
                                        Robbery
                                    </span>

                                    <strong>1</strong>
                                </div>

                                <div class="distribution-track">
                                    <span style="width: 33.33%"></span>
                                </div>
                            </div>


                            <div class="distribution-item">
                                <div class="distribution-info">
                                    <span>
                                        <i class="distribution-dot vandalism"></i>
                                        Vandalism
                                    </span>

                                    <strong>1</strong>
                                </div>

                                <div class="distribution-track">
                                    <span style="width: 33.33%"></span>
                                </div>
                            </div>

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

                            <div class="risk-donut">
                                <div class="risk-donut-center">
                                    <strong>3</strong>
                                    <span>Incidents</span>
                                </div>
                            </div>


                            <div class="risk-legend">

                                <div>
                                    <span>
                                        <i class="risk-dot high"></i>
                                        High Risk
                                    </span>

                                    <strong>1</strong>
                                </div>

                                <div>
                                    <span>
                                        <i class="risk-dot moderate"></i>
                                        Moderate
                                    </span>

                                    <strong>1</strong>
                                </div>

                                <div>
                                    <span>
                                        <i class="risk-dot monitored"></i>
                                        Monitored
                                    </span>

                                    <strong>1</strong>
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

                                <h3>Sample Incident Trend</h3>
                            </div>

                            <span class="panel-badge">
                                October 2026
                            </span>
                        </div>


                        <div class="trend-chart">

                            <div class="trend-y-axis">
                                <span>3</span>
                                <span>2</span>
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

                                    <div class="trend-bar-group">
                                        <span
                                            class="trend-bar"
                                            style="height: 28%"
                                        ></span>
                                        <small>Oct 18</small>
                                    </div>

                                    <div class="trend-bar-group">
                                        <span
                                            class="trend-bar"
                                            style="height: 42%"
                                        ></span>
                                        <small>Oct 21</small>
                                    </div>

                                    <div class="trend-bar-group">
                                        <span
                                            class="trend-bar"
                                            style="height: 58%"
                                        ></span>
                                        <small>Oct 24</small>
                                    </div>

                                    <div class="trend-bar-group">
                                        <span
                                            class="trend-bar empty"
                                            style="height: 8%"
                                        ></span>
                                        <small>Oct 27</small>
                                    </div>

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

                            <div class="area-comparison-item">
                                <span class="area-rank">01</span>

                                <div class="area-comparison-copy">
                                    <strong>North Area</strong>
                                    <span>1 sample incident</span>
                                </div>

                                <span class="area-risk high">
                                    High Risk
                                </span>
                            </div>


                            <div class="area-comparison-item">
                                <span class="area-rank">02</span>

                                <div class="area-comparison-copy">
                                    <strong>Central Area</strong>
                                    <span>1 sample incident</span>
                                </div>

                                <span class="area-risk moderate">
                                    Moderate
                                </span>
                            </div>


                            <div class="area-comparison-item">
                                <span class="area-rank">03</span>

                                <div class="area-comparison-copy">
                                    <strong>South Area</strong>
                                    <span>1 sample incident</span>
                                </div>

                                <span class="area-risk monitored">
                                    Monitored
                                </span>
                            </div>

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
                        <span>Development Notice</span>

                        <h2>
                            Analytics currently use sample front-end data.
                        </h2>

                        <p>
                            Actual crime statistics, geographic records,
                            and historical trends will be supplied through
                            the backend implementation of the system.
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
                Front-end demonstration
            </div>

        </div>
    </footer>

</body>
</html>
