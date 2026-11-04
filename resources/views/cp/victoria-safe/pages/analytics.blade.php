@extends('cp.victoria-safe.layouts.admin')

@section('title', 'Analytics')
@section('page-label', 'Analytics')

@section('content')

    <div class="vs-page-heading">
        <div>
            <span class="vs-eyebrow">DATA AND INSIGHTS</span>
            <h1>Crime Analytics</h1>
            <p>Understand crime activity through incident statistics, trends, and geographic insights.</p>
        </div>

        <div class="vs-heading-actions">
            <button type="button" class="vs-button vs-button-secondary">
                Export Analytics
            </button>
        </div>
    </div>

    <!-- Analytics Summary -->
    <div class="vs-stats-grid">

        <div class="vs-stat-card">
            <div class="vs-stat-top">
                <span class="vs-stat-label">Total Incidents</span>
                <span class="vs-stat-icon">▤</span>
            </div>
            <strong class="vs-stat-value">0</strong>
            <span class="vs-stat-note">Approved incident records</span>
        </div>

        <div class="vs-stat-card">
            <div class="vs-stat-top">
                <span class="vs-stat-label">This Month</span>
                <span class="vs-stat-icon">▦</span>
            </div>
            <strong class="vs-stat-value">0</strong>
            <span class="vs-stat-note">Approved incidents this month</span>
        </div>

        <div class="vs-stat-card">
            <div class="vs-stat-top">
                <span class="vs-stat-label">High-Risk Areas</span>
                <span class="vs-stat-icon">⚑</span>
            </div>
            <strong class="vs-stat-value">0</strong>
            <span class="vs-stat-note">Areas identified for monitoring</span>
        </div>

        <div class="vs-stat-card">
            <div class="vs-stat-top">
                <span class="vs-stat-label">Monitored Areas</span>
                <span class="vs-stat-icon">⌖</span>
            </div>
            <strong class="vs-stat-value">0</strong>
            <span class="vs-stat-note">Areas included in monitoring</span>
        </div>

    </div>

    <!-- Analytics Filters -->
    <section class="vs-panel">

        <div class="vs-panel-header">
            <div>
                <h2>Analytics Filters</h2>
                <p>Select a reporting period and category to analyze incident records.</p>
            </div>
        </div>

        <div class="vs-filter-bar">

            <select aria-label="Select reporting period" disabled>
                <option>All Time</option>
                <option>This Month</option>
                <option>Last 30 Days</option>
                <option>This Year</option>
            </select>

            <select aria-label="Filter by crime type" disabled>
                <option>All Crime Types</option>
            </select>

            <select aria-label="Filter by location" disabled>
                <option>All Areas</option>
            </select>

        </div>

    </section>

    <!-- Crime Trends -->
    <section class="vs-panel">

        <div class="vs-panel-header">
            <div>
                <h2>Crime Activity Trends</h2>
                <p>Track changes in approved incident reports over time.</p>
            </div>

            <span class="vs-panel-count">Trend Overview</span>
        </div>

        <div class="vs-chart-placeholder">
            <div class="vs-chart-placeholder-content">
                <div class="vs-chart-placeholder-icon">▥</div>
                <h3>Crime Activity Chart</h3>
                <p>
                    Monthly and yearly crime trends will be visualized here
                    once approved incident data is available.
                </p>
                <span class="vs-demo-label">Awaiting backend data</span>
            </div>
        </div>

    </section>

    <!-- Distribution -->
    <div class="vs-analytics-grid">

        <section class="vs-panel">

            <div class="vs-panel-header">
                <div>
                    <h2>Crime Type Distribution</h2>
                    <p>Breakdown of incidents by reported crime category.</p>
                </div>
            </div>

            <div class="vs-chart-placeholder vs-chart-placeholder-small">
                <div class="vs-chart-placeholder-content">
                    <div class="vs-chart-placeholder-icon">◉</div>
                    <h3>Crime Distribution</h3>
                    <p>Category statistics will appear here.</p>
                </div>
            </div>

        </section>

        <section class="vs-panel">

            <div class="vs-panel-header">
                <div>
                    <h2>Area-Based Insights</h2>
                    <p>Compare approved incident records across monitored areas.</p>
                </div>
            </div>

            <div class="vs-chart-placeholder vs-chart-placeholder-small">
                <div class="vs-chart-placeholder-content">
                    <div class="vs-chart-placeholder-icon">⌖</div>
                    <h3>Area Comparison</h3>
                    <p>Location-based statistics will appear here.</p>
                </div>
            </div>

        </section>

    </div>

    <!-- Analytics Information -->
    <section class="vs-panel vs-guidelines-panel">

        <div class="vs-panel-header">
            <div>
                <h2>Understanding the Analytics</h2>
                <p>How the system will present public safety information.</p>
            </div>
        </div>

        <div class="vs-guidelines-grid">

            <div class="vs-guideline-item">
                <span class="vs-guideline-icon">▥</span>
                <div>
                    <strong>Incident Trends</strong>
                    <p>Observe changes in approved crime reports across selected time periods.</p>
                </div>
            </div>

            <div class="vs-guideline-item">
                <span class="vs-guideline-icon">◉</span>
                <div>
                    <strong>Crime Distribution</strong>
                    <p>Understand the distribution of approved incidents by crime category.</p>
                </div>
            </div>

            <div class="vs-guideline-item">
                <span class="vs-guideline-icon">⌖</span>
                <div>
                    <strong>Geographic Insights</strong>
                    <p>Identify areas that may require closer monitoring based on available incident data.</p>
                </div>
            </div>

        </div>

    </section>

@endsection
