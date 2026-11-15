@extends('cp.victoria-safe.layouts.admin')

@section('title', 'Dashboard')
@section('page-label', 'Dashboard')

@section('content')

    <!-- PAGE HEADING -->
    <section class="vs-page-heading">
        <div>
            <span class="vs-eyebrow">PUBLIC SAFETY MANAGEMENT</span>
            <h1>Dashboard Overview</h1>
            <p>Monitor crime reports, manage submissions, and oversee public safety information.</p>
        </div>

        <div class="vs-date-display">
            <span>WORKSPACE</span>
            <strong>Victoria City</strong>
        </div>
    </section>

    <!-- STATISTICS -->
    <section class="vs-stats-grid">

        <article class="vs-stat-card">
            <div class="vs-stat-top">
                <span>Pending Requests</span>
                <div class="vs-stat-icon orange">◷</div>
            </div>
            <h2>{{ $pending ?? 0 }}</h2>
            <p>Awaiting admin review</p>
            <div class="vs-stat-footer">
                <span class="vs-stat-indicator orange-text">●</span>
                Requires attention
            </div>
        </article>

        <article class="vs-stat-card">
            <div class="vs-stat-top">
                <span>Approved Reports</span>
                <div class="vs-stat-icon green">✓</div>
            </div>
            <h2>{{ $approved ?? 0 }}</h2>
            <p>Approved submissions</p>
            <div class="vs-stat-footer">
                <span class="vs-stat-indicator green-text">●</span>
                Ready for publication
            </div>
        </article>

        <article class="vs-stat-card">
            <div class="vs-stat-top">
                <span>Flagged Duplicates</span>
                <div class="vs-stat-icon red">⚑</div>
            </div>
            <h2>{{ $pending ?? 0 }}</h2>
            <p>Potential duplicate reports</p>
            <div class="vs-stat-footer">
                <span class="vs-stat-indicator red-text">●</span>
                Requires verification
            </div>
        </article>

        <article class="vs-stat-card">
            <div class="vs-stat-top">
                <span>Published Incidents</span>
                <div class="vs-stat-icon blue">⌖</div>
            </div>
            <h2>{{ $published ?? 0 }}</h2>
            <p>Visible on public crime map</p>
            <div class="vs-stat-footer">
                <span class="vs-stat-indicator blue-text">●</span>
                Public information
            </div>
        </article>

    </section>

    <!-- MAIN DASHBOARD GRID -->
    <section class="vs-dashboard-grid">

        <article class="vs-panel vs-overview-panel">
            <div class="vs-panel-heading">
                <div>
                    <h2>Crime Activity Overview</h2>
                    <p>Summary of reported incidents</p>
                </div>
                <span class="vs-demo-label">DEMO DATA</span>
            </div>

            <div class="vs-chart-placeholder">
                <div class="vs-chart-empty-icon">▥</div>
                <strong>Crime activity chart</strong>
                <p>Analytics visualization will appear here when report data is connected.</p>
            </div>
        </article>

        <article class="vs-panel vs-quick-panel">
            <div class="vs-panel-heading">
                <div>
                    <h2>Quick Actions</h2>
                    <p>Manage your workspace</p>
                </div>
            </div>

            <a href="{{ route('statamic.cp.victoria-safe.crime-requests') }}"
               class="vs-action-item">
                <span class="vs-action-icon orange">▤</span>
                <span>
                    <strong>Review Requests</strong>
                    <small>Examine submitted crime reports</small>
                </span>
                <span class="vs-action-arrow">›</span>
            </a>

            <a href="{{ route('statamic.cp.victoria-safe.duplicate-review') }}"
               class="vs-action-item">
                <span class="vs-action-icon red">⚑</span>
                <span>
                    <strong>Check Duplicates</strong>
                    <small>Verify potentially repeated reports</small>
                </span>
                <span class="vs-action-arrow">›</span>
            </a>

            <a href="{{ route('statamic.cp.victoria-safe.crime-map') }}"
               class="vs-action-item">
                <span class="vs-action-icon blue">⌖</span>
                <span>
                    <strong>Manage Crime Map</strong>
                    <small>Oversee published incidents</small>
                </span>
                <span class="vs-action-arrow">›</span>
            </a>

            <a href="{{ route('statamic.cp.victoria-safe.analytics') }}"
               class="vs-action-item">
                <span class="vs-action-icon green">▥</span>
                <span>
                    <strong>View Analytics</strong>
                    <small>Explore crime statistics</small>
                </span>
                <span class="vs-action-arrow">›</span>
            </a>
        </article>

    </section>

    <!-- RECENT REPORTS -->
    <section class="vs-panel vs-reports-panel">

        <div class="vs-panel-heading">
            <div>
                <h2>Recent Crime Requests</h2>
                <p>Latest submissions requiring administrative attention</p>
            </div>

            <a href="{{ route('statamic.cp.victoria-safe.crime-requests') }}"
               class="vs-view-all">
                View all requests →
            </a>
        </div>

        @if (($recent ?? collect())->isEmpty())
        <div class="vs-empty-state">
            <div class="vs-empty-icon">▤</div>
            <strong>No crime requests yet</strong>
            <p>Newly submitted reports will appear here for review.</p>
        </div>
        @else
        <div class="vs-table-wrapper">
            <table class="vs-table">
                <thead>
                    <tr>
                        <th>REPORT ID</th>
                        <th>CRIME TYPE</th>
                        <th>LOCATION</th>
                        <th>STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recent as $crime)
                        <tr>
                            <td>#{{ $crime->id }}</td>
                            <td>{{ $crime->type ?? 'Unspecified' }}</td>
                            <td>{{ $crime->barangay?->name ?? 'Unassigned' }}</td>
                            <td>{{ ucfirst($crime->status) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

    </section>

@endsection
