@extends('cp.victoria-safe.layouts.admin')

@section('title', 'Crime Map Management')
@section('page-label', 'Crime Map')

@section('content')

    <div class="vs-page-heading">
        <div>
            <span class="vs-eyebrow">GEOGRAPHIC MONITORING</span>
            <h1>Crime Map Management</h1>
            <p>Monitor approved incident locations and manage their visibility on the public crime map.</p>
        </div>

        <div class="vs-heading-actions">
            <button type="button" class="vs-button vs-button-secondary">
                Map Settings
            </button>
        </div>
    </div>

    <!-- Map Summary -->
    <div class="vs-stats-grid">

        <div class="vs-stat-card">
            <div class="vs-stat-top">
                <span class="vs-stat-label">Mapped Incidents</span>
                <span class="vs-stat-icon">⌖</span>
            </div>
            <strong class="vs-stat-value">0</strong>
            <span class="vs-stat-note">Approved incidents with coordinates</span>
        </div>

        <div class="vs-stat-card">
            <div class="vs-stat-top">
                <span class="vs-stat-label">Visible on Public Map</span>
                <span class="vs-stat-icon">◉</span>
            </div>
            <strong class="vs-stat-value">0</strong>
            <span class="vs-stat-note">Published map records</span>
        </div>

        <div class="vs-stat-card">
            <div class="vs-stat-top">
                <span class="vs-stat-label">Missing Coordinates</span>
                <span class="vs-stat-icon">!</span>
            </div>
            <strong class="vs-stat-value">0</strong>
            <span class="vs-stat-note">Records needing location verification</span>
        </div>

        <div class="vs-stat-card">
            <div class="vs-stat-top">
                <span class="vs-stat-label">Monitored Areas</span>
                <span class="vs-stat-icon">▦</span>
            </div>
            <strong class="vs-stat-value">0</strong>
            <span class="vs-stat-note">Areas with mapped incidents</span>
        </div>

    </div>

    <!-- Map Preview -->
    <section class="vs-panel">

        <div class="vs-panel-header">
            <div>
                <h2>Victoria City Incident Map</h2>
                <p>Preview of approved incident locations for geographic monitoring.</p>
            </div>

            <span class="vs-panel-count">Map Preview</span>
        </div>

        <div class="vs-map-placeholder">

            <div class="vs-map-placeholder-content">
                <div class="vs-map-placeholder-icon">⌖</div>
                <h3>Crime Map Preview</h3>
                <p>
                    The interactive map and incident markers will appear here
                    when the map service and backend data are connected.
                </p>
                <span class="vs-demo-label">Front-end demonstration</span>
            </div>

        </div>

        <div class="vs-map-legend">
            <span><i class="vs-legend-dot vs-legend-red"></i> High-risk incidents</span>
            <span><i class="vs-legend-dot vs-legend-yellow"></i> Moderate-risk incidents</span>
            <span><i class="vs-legend-dot vs-legend-blue"></i> Other approved incidents</span>
        </div>

    </section>

    <!-- Map Filters -->
    <section class="vs-panel">

        <div class="vs-panel-header">
            <div>
                <h2>Map Filters</h2>
                <p>These controls are planned for filtering mapped incident records.</p>
            </div>
        </div>

        <div class="vs-filter-bar">

            <select aria-label="Filter by crime type" disabled>
                <option>All Crime Types</option>
            </select>

            <select aria-label="Filter by risk level" disabled>
                <option>All Risk Levels</option>
                <option>High Risk</option>
                <option>Moderate Risk</option>
                <option>Low Risk</option>
            </select>

            <select aria-label="Filter by publication status" disabled>
                <option>All Publication Statuses</option>
                <option>Visible</option>
                <option>Hidden</option>
            </select>

        </div>

    </section>

    <!-- Mapped Incidents Table -->
    <section class="vs-panel">

        <div class="vs-panel-header">
            <div>
                <h2>Mapped Incident Records</h2>
                <p>Review location details and public map visibility.</p>
            </div>

            <span class="vs-panel-count">0 Records</span>
        </div>

        <div class="vs-table-wrapper">
            <table class="vs-table">
                <thead>
                    <tr>
                        <th>INCIDENT ID</th>
                        <th>CRIME TYPE</th>
                        <th>LOCATION</th>
                        <th>LATITUDE</th>
                        <th>LONGITUDE</th>
                        <th>MAP VISIBILITY</th>
                        <th>ACTION</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td colspan="7" class="vs-empty-cell">
                            <div class="vs-empty-state">
                                <div class="vs-empty-icon">⌖</div>
                                <h3>No mapped incidents yet</h3>
                                <p>
                                    Approved incidents with verified coordinates
                                    will appear here once connected.
                                </p>
                                <span class="vs-demo-label">
                                    Front-end demonstration
                                </span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="vs-table-footer">
            <span>Showing 0 of 0 mapped incidents</span>
            <span>Map records are not yet connected to the backend</span>
        </div>

    </section>

    <!-- Map Management Guidelines -->
    <section class="vs-panel vs-guidelines-panel">

        <div class="vs-panel-header">
            <div>
                <h2>Map Management Guidelines</h2>
                <p>Important reminders for maintaining reliable public map information.</p>
            </div>
        </div>

        <div class="vs-guidelines-grid">

            <div class="vs-guideline-item">
                <span class="vs-guideline-icon">⌖</span>
                <div>
                    <strong>Verify Coordinates</strong>
                    <p>Check incident coordinates and ensure that map markers point to appropriate locations.</p>
                </div>
            </div>

            <div class="vs-guideline-item">
                <span class="vs-guideline-icon">✓</span>
                <div>
                    <strong>Show Approved Records Only</strong>
                    <p>Only verified and approved incidents should be considered for public map display.</p>
                </div>
            </div>

            <div class="vs-guideline-item">
                <span class="vs-guideline-icon">▣</span>
                <div>
                    <strong>Protect Location Privacy</strong>
                    <p>Avoid exposing precise private addresses or details that could identify victims or reporters.</p>
                </div>
            </div>

        </div>

    </section>

@endsection
