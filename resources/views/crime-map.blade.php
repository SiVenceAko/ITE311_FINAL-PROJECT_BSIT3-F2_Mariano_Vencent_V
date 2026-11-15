<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta
        name="description"
        content="Review database-backed crime incident records and safety information         Across Victoria, Oriental Mindoro."
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

                <a href="{{ route('analytics-dashboard') }}" class="nav-link">
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

                <a href="{{ route('crime-reports.create') }}" class="btn btn-primary">
                    Report Incident
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
                        <span>Across Victoria, Oriental Mindoro.</span>
                    </h1>

                    <p class="crime-map-description">
                        Review incident records from the database, filter reports,
                        and explore the information currently available for each
                        recorded barangay.
                    </p>

                </div>

                <div class="crime-map-hero-status">
                    <span class="crime-map-status-dot"></span>

                    <div>
                        <strong>Database-backed records</strong>
                        <span>Incident details are loaded from the database</span>
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
                            Use the available filters to explore recorded incidents.
                        </p>
                    </div>

                    <div class="map-summary">
                        <span
                            class="map-summary-number"
                            id="visible-incident-count"
                        >
                            {{ $crimes->count() }}
                        </span>

                        <span class="map-summary-label">
                            Total incidents
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
                                @foreach ($crimeTypes as $crimeType)
                                    <option value="{{ strtolower($crimeType) }}">
                                        {{ ucfirst($crimeType) }}
                                    </option>
                                @endforeach
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
                                These records are loaded from the project database.
                            </p>
                        </div>

                    </aside>


                    {{-- Map Area --}}
                    <div class="crime-map-panel">

                        <div class="crime-map-canvas">

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

                                    Victoria, Oriental Mindoro
                                </span>

                                <span class="crime-map-provider-badge">
                                    OpenStreetMap
                                </span>

                            </div>

                            <div
                                id="crime-map"
                                class="crime-map-leaflet"
                                role="application"
                                aria-label="Interactive map of Victoria, Oriental Mindoro with mapped crime incidents"
                            ></div>

                            <p
                                class="crime-map-status"
                                id="crime-map-status"
                                role="status"
                                aria-live="polite"
                            >
                                Loading map…
                            </p>
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
                            Database Reports
                        </span>

                        <h2 class="section-title">
                            Visible Incidents
                        </h2>

                        <p class="section-description">
                            Reports currently stored in the project's database.
                        </p>
                    </div>

                    <span
                        class="incident-count"
                        id="incident-count-label"
                    >
                        {{ $crimes->count() }} incidents
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


                    @forelse ($crimes as $crime)
                        @php
                            $location = $crime->barangay?->name ?? 'Unassigned';
                            $riskLevel = in_array($crime->risk_level, ['high', 'moderate', 'monitored'], true)
                                ? $crime->risk_level
                                : 'monitored';
                        @endphp
                        <article
                            class="incident-row"
                            data-incident-row
                            data-id="{{ $crime->id }}"
                            data-type="{{ strtolower($crime->type ?? 'unspecified') }}"
                            data-location="{{ strtolower($location) }}"
                            data-date="{{ $crime->date?->format('Y-m-d') }}"
                            data-risk="{{ $riskLevel }}"
                            data-latitude="{{ $crime->latitude }}"
                            data-longitude="{{ $crime->longitude }}"
                            data-description="{{ $crime->description }}"
                        >
                            <div class="incident-type">
                                <span class="incident-icon {{ $riskLevel }}" aria-hidden="true">
                                    {{ strtoupper(substr($crime->type ?? '?', 0, 1)) }}
                                </span>

                                <div>
                                    <strong>{{ ucfirst($crime->type ?? 'Unspecified') }}</strong>
                                    <small>Incident #{{ $crime->id }}</small>
                                </div>
                            </div>

                            <span>{{ $location }}</span>
                            <span>{{ $crime->date?->format('M d, Y') ?? 'No date' }}</span>

                            <span>
                                <span class="risk-badge {{ $riskLevel }}">
                                    {{ $riskLevel === 'high' ? 'High Risk' : ucfirst($riskLevel) }}
                                </span>
                            </span>

                            <button
                                type="button"
                                class="incident-view-button"
                                data-view-incident="{{ $crime->id }}"
                            >
                                View Details
                            </button>
                        </article>
                    @empty
                        <p class="incident-empty-state">
                            No incident records are in the database yet.
                        </p>
                    @endforelse

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
                            Crime reports shown here are database records.
                        </h2>

                        <p>
                            Only incidents with saved coordinates appear on the
                            map. Confirm reports through official sources.
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
                        Database Record
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

                <div class="incident-detail-item">
                    <span>Description</span>
                    <strong id="modal-incident-description">—</strong>
                </div>

                <div class="incident-modal-notice">
                    <strong>Verification Notice</strong>

                    <p>
                        This page displays stored reports. It does not confirm
                        whether a report is verified or official.
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
                &copy; {{ date('Y') }} Victoria, Oriental Mindoro Crime Mapping System
            </p>

            <div class="footer-status">
                <span class="footer-status-dot"></span>
                Database-backed records
            </div>

        </div>
    </footer>

</body>
</html>
