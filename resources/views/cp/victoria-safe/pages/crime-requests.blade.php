@extends('cp.victoria-safe.layouts.admin')

@section('title', 'Crime Requests')
@section('page-label', 'Crime Requests')

@section('content')

    <div class="vs-page-heading">
        <div>
            <span class="vs-eyebrow">REPORT MANAGEMENT</span>
            <h1>Crime Requests</h1>
            <p>Review and manage crime reports submitted by the public.</p>
        </div>

        <div class="vs-heading-actions">
            <button type="button" class="vs-button vs-button-secondary">
                Export Reports
            </button>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="vs-stats-grid">

        <div class="vs-stat-card">
            <div class="vs-stat-top">
                <span class="vs-stat-label">Total Requests</span>
                <span class="vs-stat-icon">▤</span>
            </div>
            <strong class="vs-stat-value">0</strong>
            <span class="vs-stat-note">All submitted reports</span>
        </div>

        <div class="vs-stat-card">
            <div class="vs-stat-top">
                <span class="vs-stat-label">Pending Review</span>
                <span class="vs-stat-icon">◷</span>
            </div>
            <strong class="vs-stat-value">0</strong>
            <span class="vs-stat-note">Awaiting administrator review</span>
        </div>

        <div class="vs-stat-card">
            <div class="vs-stat-top">
                <span class="vs-stat-label">Approved</span>
                <span class="vs-stat-icon">✓</span>
            </div>
            <strong class="vs-stat-value">0</strong>
            <span class="vs-stat-note">Approved crime reports</span>
        </div>

        <div class="vs-stat-card">
            <div class="vs-stat-top">
                <span class="vs-stat-label">Rejected</span>
                <span class="vs-stat-icon">×</span>
            </div>
            <strong class="vs-stat-value">0</strong>
            <span class="vs-stat-note">Reports not accepted</span>
        </div>

    </div>

    <!-- Requests Panel -->
    <section class="vs-panel">

        <div class="vs-panel-header">
            <div>
                <h2>Submitted Reports</h2>
                <p>Review the information provided in each crime report.</p>
            </div>

            <span class="vs-panel-count">0 Requests</span>
        </div>

        <!-- Filters -->
        <div class="vs-filter-bar">

            <div class="vs-search-field">
                <span>⌕</span>
                <input
                    type="search"
                    placeholder="Search report ID or crime type..."
                    aria-label="Search crime requests"
                    disabled
                >
            </div>

            <select aria-label="Filter by status" disabled>
                <option>All Statuses</option>
                <option>Pending</option>
                <option>Approved</option>
                <option>Rejected</option>
                <option>Possible Duplicate</option>
            </select>

            <select aria-label="Filter by crime type" disabled>
                <option>All Crime Types</option>
            </select>

        </div>

        <!-- Table -->
        <div class="vs-table-wrapper">
            <table class="vs-table">
                <thead>
                    <tr>
                        <th>REPORT ID</th>
                        <th>CRIME TYPE</th>
                        <th>LOCATION</th>
                        <th>DATE REPORTED</th>
                        <th>STATUS</th>
                        <th>ACTION</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td colspan="6" class="vs-empty-cell">
                            <div class="vs-empty-state">
                                <div class="vs-empty-icon">▤</div>
                                <h3>No crime requests yet</h3>
                                <p>
                                    Submitted crime reports will appear here
                                    when the reporting feature is connected.
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
            <span>Showing 0 of 0 requests</span>
            <span>Data will be connected to the backend</span>
        </div>

    </section>

    <!-- Review Guidelines -->
    <section class="vs-panel vs-guidelines-panel">

        <div class="vs-panel-header">
            <div>
                <h2>Review Guidelines</h2>
                <p>Important reminders when reviewing submitted reports.</p>
            </div>
        </div>

        <div class="vs-guidelines-grid">

            <div class="vs-guideline-item">
                <span class="vs-guideline-icon">✓</span>
                <div>
                    <strong>Verify Report Details</strong>
                    <p>Check the report information and submitted location before making a decision.</p>
                </div>
            </div>

            <div class="vs-guideline-item">
                <span class="vs-guideline-icon">◎</span>
                <div>
                    <strong>Check Possible Duplicates</strong>
                    <p>Review similar reports before approving another incident record.</p>
                </div>
            </div>

            <div class="vs-guideline-item">
                <span class="vs-guideline-icon">⌑</span>
                <div>
                    <strong>Protect Personal Information</strong>
                    <p>Keep reporter and other sensitive personal details confidential.</p>
                </div>
            </div>

        </div>

    </section>

@endsection
