<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta
        name="description"
        content="Explore sample crime incident locations and safety information across Victoria City."
    >

    <title>Crime Map | Victoria City Crime Mapping System</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="crime-map-page">

    {{-- Header --}}
    <header class="site-header crime-map-header">
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

                <a href="{{ route('crime-map') }}" class="nav-link active">
                    Crime Map
                </a>

                <a href="{{ route('home') }}#overview" class="nav-link">
                    Safety Overview
                </a>

                <a href="{{ route('home') }}#features" class="nav-link">
                    Features
                </a>
            </nav>

            <div class="nav-actions">
                <a href="#incident-list" class="btn btn-primary">
                    View Incidents
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

        {{-- Page Hero --}}
        <section class="crime-map-hero">
            <div class="container crime-map-hero-content">

                <div class="crime-map-hero-copy">

                    <div class="hero-eyebrow">
                        <span class="hero-eyebrow-dot"></span>
                        Crime Intelligence
                    </div>

                    <h1 class="crime-map-title">
                        Explore Crime Activity
                        <span>Across Victoria City.</span>
                    </h1>

                    <p class="crime-map-description">
                        Explore sample incident locations, filter visible reports,
                        and identify areas that may require closer attention through
                        a clear map-based safety interface.
                    </p>

                </div>

                <div class="crime-map-hero-status">
                    <span class="crime-map-status-dot"></span>

                    <div>
                        <strong>Front-end demonstration</strong>
                        <span>Sample incident information only</span>
                    </div>
                </div>

            </div>
        </section>


        {{-- Main Crime Map Workspace --}}
        <section class="crime-map-workspace">
            <div class="container">

                <div class="crime-map-toolbar">

                    <div>
                        <span class="section-eyebrow">Map Explorer</span>

                        <h2>Crime Incident Map</h2>

                        <p>
                            Use the available filters to explore sample incidents
                            displayed across the map.
                        </p>
                    </div>

                    <div class="map-summary">
                        <span
                            class="map-summary-number"
                            id="visible-incident-count"
                        >
                            3
                        </span>

                        <span class="map-summary-label">
                            Visible sample incidents
                        </span>
                    </div>

                </div>


                <div class="crime-map-layout">

                    {{-- Filter Sidebar --}}
                    <aside class="crime-filter-panel">

                        <div class="filter-panel-header">
                            <div>
                                <span class="filter-label-small">
                                    Refine Results
                                </span>

                                <h3>Filter Incidents</h3>
                            </div>

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                aria-hidden="true"
                            >
                                <path d="M4 5h16"/>
                                <path d="M7 12h10"/>
                                <path d="M10 19h4"/>
                            </svg>
                        </div>


                        <div class="filter-group">
                            <label for="location-search">
                                Search Location
                            </label>

                            <div class="filter-input-wrapper">
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    aria-hidden="true"
                                >
                                    <circle cx="11" cy="11" r="7"/>
                                    <path d="m20 20-4-4"/>
                                </svg>

                                <input
                                    type="search"
                                    id="location-search"
                                    placeholder="Search barangay or area"
                                    autocomplete="off"
                                >
                            </div>
                        </div>


                        <div class="filter-group">
                            <label for="crime-type">
                                Crime Type
                            </label>

                            <select id="crime-type">
                                <option value="all">All Crime Types</option>
                                <option value="theft">Theft</option>
                                <option value="robbery">Robbery</option>
                                <option value="assault">Assault</option>
                                <option value="burglary">Burglary</option>
                                <option value="vandalism">Vandalism</option>
                            </select>
                        </div>


                        <div class="filter-group">
                            <label for="risk-level">
                                Risk Level
                            </label>

                            <select id="risk-level">
                                <option value="all">All Risk Levels</option>
                                <option value="monitored">Monitored</option>
                                <option value="moderate">Moderate Risk</option>
                                <option value="high">High Risk</option>
                            </select>
                        </div>


                        <div class="filter-group">
                            <label for="incident-date">
                                Incident Date
                            </label>

                            <input
                                type="date"
                                id="incident-date"
                            >
                        </div>


                        <button
                            type="button"
                            class="filter-reset-button"
                        >
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                aria-hidden="true"
                            >
                                <path d="M3 12a9 9 0 1 0 3-6.7"/>
                                <path d="M3 4v6h6"/>
                            </svg>

                            Reset Filters
                        </button>


                        <div class="filter-information">
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

                            <p>
                                Filters currently use sample front-end incident
                                data for demonstration purposes.
                            </p>
                        </div>

                    </aside>


                    {{-- Map Area --}}
                    <div class="crime-map-panel">

                        <div class="crime-map-canvas">

                            <div class="crime-map-grid"></div>

                            {{-- Mock Roads --}}
                            <span class="crime-road crime-road-one"></span>
                            <span class="crime-road crime-road-two"></span>
                            <span class="crime-road crime-road-three"></span>
                            <span class="crime-road crime-road-four"></span>
                            <span class="crime-road crime-road-five"></span>


                            {{-- Map Top Controls --}}
                            <div class="crime-map-top-controls">

                                <span class="crime-map-location">
                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        aria-hidden="true"
                                    >
                                        <path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"/>
                                        <circle cx="12" cy="10" r="2.5"/>
                                    </svg>

                                    Victoria City
                                </span>

                                <span class="crime-map-demo-badge">
                                    Demo Map
                                </span>

                            </div>


                            {{-- Map Labels --}}
                            <span class="map-area-label map-area-one">
                                North Area
                            </span>

                            <span class="map-area-label map-area-two">
                                Central Area
                            </span>

                            <span class="map-area-label map-area-three">
                                South Area
                            </span>


                            {{-- Sample Incident Markers --}}
                            <button
                                type="button"
                                class="incident-marker high marker-one"
                                data-marker-id="002"
                                aria-label="View robbery incident in North Area"
                            >
                                <span></span>
                            </button>

                            <button
                                type="button"
                                class="incident-marker moderate marker-two"
                                data-marker-id="001"
                                aria-label="View theft incident in Central Area"
                            >
                                <span></span>
                            </button>

                            <button
                                type="button"
                                class="incident-marker monitored marker-three"
                                data-marker-id="003"
                                aria-label="View vandalism incident in South Area"
                            >
                                <span></span>
                            </button>

                            <button
                                type="button"
                                class="incident-marker high marker-four"
                                aria-label="Decorative sample high risk marker"
                            >
                                <span></span>
                            </button>

                            <button
                                type="button"
                                class="incident-marker moderate marker-five"
                                aria-label="Decorative sample moderate risk marker"
                            >
                                <span></span>
                            </button>

                            <button
                                type="button"
                                class="incident-marker monitored marker-six"
                                aria-label="Decorative sample monitored marker"
                            >
                                <span></span>
                            </button>


                            {{-- Map Zoom Controls --}}
                            <div class="map-zoom-controls">
                                <button
                                    type="button"
                                    aria-label="Zoom in"
                                >
                                    +
                                </button>

                                <button
                                    type="button"
                                    aria-label="Zoom out"
                                >
                                    −
                                </button>
                            </div>


                            {{-- Legend --}}
                            <div class="crime-map-legend">

                                <span class="crime-map-legend-title">
                                    Risk Level
                                </span>

                                <div class="crime-map-legend-items">

                                    <span>
                                        <i class="legend-dot low"></i>
                                        Monitored
                                    </span>

                                    <span>
                                        <i class="legend-dot medium"></i>
                                        Moderate
                                    </span>

                                    <span>
                                        <i class="legend-dot high"></i>
                                        High Risk
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </section>


        {{-- Incident List --}}
        <section
            class="crime-incidents-section section"
            id="incident-list"
        >
            <div class="container">

                <div class="incident-section-header">

                    <div class="section-heading">
                        <span class="section-eyebrow">
                            Sample Reports
                        </span>

                        <h2 class="section-title">
                            Visible Incidents
                        </h2>

                        <p class="section-description">
                            Sample records shown for interface development.
                            These entries do not represent actual crime reports.
                        </p>
                    </div>

                    <span
                        class="incident-count"
                        id="incident-count-label"
                    >
                        3 sample records
                    </span>

                </div>


                <div class="incident-table-wrapper">

                    <div class="incident-table-header">
                        <span>Incident</span>
                        <span>Location</span>
                        <span>Date</span>
                        <span>Risk Level</span>
                        <span>Action</span>
                    </div>


                    {{-- Sample Incident #001 --}}
                    <article
                        class="incident-row"
                        data-incident-row
                        data-id="001"
                        data-type="theft"
                        data-location="central area"
                        data-date="2026-10-24"
                        data-risk="moderate"
                    >
                        <div class="incident-type">
                            <span class="incident-icon theft">
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    aria-hidden="true"
                                >
                                    <path d="M5 8h14l-1 12H6L5 8Z"/>
                                    <path d="M9 8V6a3 3 0 0 1 6 0v2"/>
                                </svg>
                            </span>

                            <div>
                                <strong>Theft</strong>
                                <small>Sample Incident #001</small>
                            </div>
                        </div>

                        <span>Central Area</span>
                        <span>Oct. 24, 2026</span>

                        <span>
                            <span class="risk-badge moderate">
                                Moderate
                            </span>
                        </span>

                        <button
                            type="button"
                            class="incident-view-button"
                            data-view-incident="001"
                        >
                            View Details
                        </button>
                    </article>


                    {{-- Sample Incident #002 --}}
                    <article
                        class="incident-row"
                        data-incident-row
                        data-id="002"
                        data-type="robbery"
                        data-location="north area"
                        data-date="2026-10-21"
                        data-risk="high"
                    >
                        <div class="incident-type">
                            <span class="incident-icon robbery">
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    aria-hidden="true"
                                >
                                    <path d="M12 3v18"/>
                                    <path d="M17 7H9.5a2.5 2.5 0 0 0 0 5h5a2.5 2.5 0 0 1 0 5H7"/>
                                </svg>
                            </span>

                            <div>
                                <strong>Robbery</strong>
                                <small>Sample Incident #002</small>
                            </div>
                        </div>

                        <span>North Area</span>
                        <span>Oct. 21, 2026</span>

                        <span>
                            <span class="risk-badge high">
                                High Risk
                            </span>
                        </span>

                        <button
                            type="button"
                            class="incident-view-button"
                            data-view-incident="002"
                        >
                            View Details
                        </button>
                    </article>


                    {{-- Sample Incident #003 --}}
                    <article
                        class="incident-row"
                        data-incident-row
                        data-id="003"
                        data-type="vandalism"
                        data-location="south area"
                        data-date="2026-10-18"
                        data-risk="monitored"
                    >
                        <div class="incident-type">
                            <span class="incident-icon monitored">
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    aria-hidden="true"
                                >
                                    <path d="M4 19 10 5l4 9 2-5 4 10"/>
                                </svg>
                            </span>

                            <div>
                                <strong>Vandalism</strong>
                                <small>Sample Incident #003</small>
                            </div>
                        </div>

                        <span>South Area</span>
                        <span>Oct. 18, 2026</span>

                        <span>
                            <span class="risk-badge monitored">
                                Monitored
                            </span>
                        </span>

                        <button
                            type="button"
                            class="incident-view-button"
                            data-view-incident="003"
                        >
                            View Details
                        </button>
                    </article>

                </div>

            </div>
        </section>


        {{-- Safety Notice --}}
        <section class="map-safety-notice">
            <div class="container">

                <div class="map-safety-notice-inner">

                    <div class="map-safety-notice-icon">
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
                            <path d="M12 8v4"/>
                            <path d="M12 15h.01"/>
                        </svg>
                    </div>

                    <div>
                        <span>Development Notice</span>

                        <h2>
                            Crime information displayed on this page is sample data.
                        </h2>

                        <p>
                            Actual incident records and geographic information
                            will be connected through the project's backend
                            implementation.
                        </p>
                    </div>

                </div>

            </div>
        </section>

    </main>


    {{-- Footer --}}
        {{-- Incident Details Modal --}}
    <div
        class="incident-modal"
        id="incident-modal"
        aria-hidden="true"
    >
        <div
            class="incident-modal-backdrop"
            data-close-incident-modal
        ></div>

        <div
            class="incident-modal-dialog"
            role="dialog"
            aria-modal="true"
            aria-labelledby="incident-modal-title"
        >
            <div class="incident-modal-header">
                <div>
                    <span class="section-eyebrow">
                        Sample Incident
                    </span>

                    <h2 id="incident-modal-title">
                        Incident Details
                    </h2>
                </div>

                <button
                    type="button"
                    class="incident-modal-close"
                    data-close-incident-modal
                    aria-label="Close incident details"
                >
                    &times;
                </button>
            </div>

            <div class="incident-modal-body">

                <div class="incident-detail-item">
                    <span>Incident ID</span>
                    <strong id="modal-incident-id">—</strong>
                </div>

                <div class="incident-detail-item">
                    <span>Crime Type</span>
                    <strong id="modal-incident-type">—</strong>
                </div>

                <div class="incident-detail-item">
                    <span>Location</span>
                    <strong id="modal-incident-location">—</strong>
                </div>

                <div class="incident-detail-item">
                    <span>Date</span>
                    <strong id="modal-incident-date">—</strong>
                </div>

                <div class="incident-detail-item">
                    <span>Risk Level</span>
                    <strong id="modal-incident-risk">—</strong>
                </div>

                <div class="incident-modal-notice">
                    <strong>Development Notice</strong>

                    <p>
                        This is sample incident information used for the
                        front-end demonstration. Actual crime records will
                        be provided by the backend implementation.
                    </p>
                </div>

            </div>

            <div class="incident-modal-footer">
                <button
                    type="button"
                    class="btn btn-primary"
                    data-close-incident-modal
                >
                    Close Details
                </button>
            </div>
        </div>
    </div>

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
