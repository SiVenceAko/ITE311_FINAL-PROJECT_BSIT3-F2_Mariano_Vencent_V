@extends('cp.victoria-safe.layouts.admin')

@section('title', 'Approved Incidents')
@section('page-label', 'Approved Incidents')

@section('content')

    <div class="vs-page-heading">
        <div>
            <span class="vs-eyebrow">INCIDENT MANAGEMENT</span>
            <h1>Approved Incidents</h1>
            <p>Manage verified crime incidents approved for the public safety platform.</p>
        </div>

        <div class="vs-heading-actions">
            <button type="button" class="vs-button vs-button-secondary">
                Export Incidents
            </button>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="vs-stats-grid">

        <div class="vs-stat-card">
            <div class="vs-stat-top">
                <span class="vs-stat-label">Total Approved</span>
                <span class="vs-stat-icon">✓</span>
            </div>
            <strong class="vs-stat-value">{{ $crimes->count() }}</strong>
            <span class="vs-stat-note">All approved incident records</span>
        </div>

        <div class="vs-stat-card">
            <div class="vs-stat-top">
                <span class="vs-stat-label">Published</span>
                <span class="vs-stat-icon">◉</span>
            </div>
            <strong class="vs-stat-value">{{ $crimes->whereNotNull('latitude')->whereNotNull('longitude')->count() }}</strong>
            <span class="vs-stat-note">Visible on the public platform</span>
        </div>

        <div class="vs-stat-card">
            <div class="vs-stat-top">
                <span class="vs-stat-label">Unpublished</span>
                <span class="vs-stat-icon">◷</span>
            </div>
            <strong class="vs-stat-value">{{ $crimes->where(fn($c) => is_null($c->latitude) || is_null($c->longitude))->count() }}</strong>
            <span class="vs-stat-note">Approved but not yet published</span>
        </div>

        <div class="vs-stat-card">
            <div class="vs-stat-top">
                <span class="vs-stat-label">Recently Approved</span>
                <span class="vs-stat-icon">↗</span>
            </div>
            <strong class="vs-stat-value">{{ $crimes->filter(fn($c) => $c->updated_at?->isCurrentMonth())->count() }}</strong>
            <span class="vs-stat-note">Approved this month</span>
        </div>

    </div>

    <!-- Approved Incidents Table -->
    <section class="vs-panel">

        <div class="vs-panel-header">
            <div>
                <h2>Incident Records</h2>
                <p>View and manage approved crime incident information.</p>
            </div>

            <span class="vs-panel-count">{{ $crimes->count() }} Incidents</span>
        </div>

        <!-- Filters -->
        <div class="vs-filter-bar">

            <div class="vs-search-field">
                <span>⌕</span>
                <input
                    type="search"
                    placeholder="Search incident ID or location..."
                    aria-label="Search approved incidents"
                    disabled
                >
            </div>

            <select aria-label="Filter by crime type" disabled>
                <option>All Crime Types</option>
            </select>

            <select aria-label="Filter publication status" disabled>
                <option>All Publication Statuses</option>
                <option>Published</option>
                <option>Unpublished</option>
            </select>

        </div>

        <div class="vs-table-wrapper">
            <table class="vs-table">
                <thead>
                    <tr>
                        <th>INCIDENT ID</th>
                        <th>CRIME TYPE</th>
                        <th>LOCATION</th>
                        <th>INCIDENT DATE</th>
                        <th>APPROVAL DATE</th>
                        <th>PUBLICATION</th>
                        <th>ACTION</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($crimes as $crime)
                        <tr>
                            <td>#{{ $crime->id }}</td>
                            <td>{{ $crime->type ?? 'Unspecified' }}</td>
                            <td>{{ $crime->barangay?->name ?? 'Unassigned' }}</td>
                            <td>{{ $crime->date?->format('M d, Y') ?? 'No date' }}</td>
                            <td>{{ $crime->updated_at?->format('M d, Y') ?? '—' }}</td>
                            <td>{{ $crime->latitude && $crime->longitude ? 'Published' : 'Unpublished' }}</td>
                            <td>—</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="vs-empty-cell">
                                <div class="vs-empty-state">
                                    <div class="vs-empty-icon">✓</div>
                                    <h3>No approved incidents yet</h3>
                                    <p>Verified and approved crime reports will appear here.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="vs-table-footer">
            <span>Showing 0 of 0 incidents</span>
            <span>Incident records are not yet connected to the database</span>
        </div>

    </section>

    <!-- Publication Information -->
    <section class="vs-panel vs-guidelines-panel">

        <div class="vs-panel-header">
            <div>
                <h2>Publication Guidelines</h2>
                <p>Important considerations before making an incident visible publicly.</p>
            </div>
        </div>

        <div class="vs-guidelines-grid">

            <div class="vs-guideline-item">
                <span class="vs-guideline-icon">✓</span>
                <div>
                    <strong>Verify Before Publishing</strong>
                    <p>Only reviewed and approved incident records should be considered for public display.</p>
                </div>
            </div>

            <div class="vs-guideline-item">
                <span class="vs-guideline-icon">⌖</span>
                <div>
                    <strong>Check Location Accuracy</strong>
                    <p>Ensure that the incident location is appropriate and accurate for public mapping.</p>
                </div>
            </div>

            <div class="vs-guideline-item">
                <span class="vs-guideline-icon">▣</span>
                <div>
                    <strong>Protect Confidential Information</strong>
                    <p>Never expose reporter identities, victim details, or sensitive personal information.</p>
                </div>
            </div>

        </div>

    </section>

@endsection
