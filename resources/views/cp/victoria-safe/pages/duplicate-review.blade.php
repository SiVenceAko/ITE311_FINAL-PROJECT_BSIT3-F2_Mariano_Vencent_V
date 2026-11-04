@extends('cp.victoria-safe.layouts.admin')

@section('title', 'Duplicate Review')
@section('page-label', 'Duplicate Review')

@section('content')

    <div class="vs-page-heading">
        <div>
            <span class="vs-eyebrow">REPORT VERIFICATION</span>
            <h1>Duplicate Review</h1>
            <p>Identify and review reports that may describe the same crime incident.</p>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="vs-stats-grid">

        <div class="vs-stat-card">
            <div class="vs-stat-top">
                <span class="vs-stat-label">Flagged Reports</span>
                <span class="vs-stat-icon">⚑</span>
            </div>
            <strong class="vs-stat-value">0</strong>
            <span class="vs-stat-note">Reports marked for duplicate checking</span>
        </div>

        <div class="vs-stat-card">
            <div class="vs-stat-top">
                <span class="vs-stat-label">Under Review</span>
                <span class="vs-stat-icon">◷</span>
            </div>
            <strong class="vs-stat-value">0</strong>
            <span class="vs-stat-note">Awaiting administrator verification</span>
        </div>

        <div class="vs-stat-card">
            <div class="vs-stat-top">
                <span class="vs-stat-label">Confirmed Duplicates</span>
                <span class="vs-stat-icon">◎</span>
            </div>
            <strong class="vs-stat-value">0</strong>
            <span class="vs-stat-note">Verified as duplicate reports</span>
        </div>

        <div class="vs-stat-card">
            <div class="vs-stat-top">
                <span class="vs-stat-label">Unique Reports</span>
                <span class="vs-stat-icon">✓</span>
            </div>
            <strong class="vs-stat-value">0</strong>
            <span class="vs-stat-note">Verified as separate incidents</span>
        </div>

    </div>

    <!-- Duplicate Review Panel -->
    <section class="vs-panel">

        <div class="vs-panel-header">
            <div>
                <h2>Possible Duplicate Reports</h2>
                <p>Compare flagged reports before confirming their status.</p>
            </div>

            <span class="vs-panel-count">0 Flagged</span>
        </div>

        <div class="vs-filter-bar">

            <div class="vs-search-field">
                <span>⌕</span>
                <input
                    type="search"
                    placeholder="Search report ID or location..."
                    aria-label="Search flagged reports"
                    disabled
                >
            </div>

            <select aria-label="Filter duplicate review status" disabled>
                <option>All Review Statuses</option>
                <option>Pending Review</option>
                <option>Confirmed Duplicate</option>
                <option>Unique Incident</option>
            </select>

        </div>

        <div class="vs-table-wrapper">
            <table class="vs-table">
                <thead>
                    <tr>
                        <th>REPORT ID</th>
                        <th>CRIME TYPE</th>
                        <th>REPORTED LOCATION</th>
                        <th>INCIDENT DATE</th>
                        <th>MATCH REASON</th>
                        <th>REVIEW STATUS</th>
                        <th>ACTION</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td colspan="7" class="vs-empty-cell">
                            <div class="vs-empty-state">
                                <div class="vs-empty-icon">◎</div>
                                <h3>No flagged reports</h3>
                                <p>
                                    Possible duplicate submissions will appear
                                    here when duplicate detection is connected.
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
            <span>Showing 0 of 0 flagged reports</span>
            <span>Duplicate verification is not yet connected</span>
        </div>

    </section>

    <!-- Review Process -->
    <section class="vs-panel">

        <div class="vs-panel-header">
            <div>
                <h2>Duplicate Verification Process</h2>
                <p>Follow these steps before marking a report as a duplicate.</p>
            </div>
        </div>

        <div class="vs-guidelines-grid">

            <div class="vs-guideline-item">
                <span class="vs-guideline-icon">01</span>
                <div>
                    <strong>Compare Incident Details</strong>
                    <p>Check the crime type, incident date, time, and reported location.</p>
                </div>
            </div>

            <div class="vs-guideline-item">
                <span class="vs-guideline-icon">02</span>
                <div>
                    <strong>Verify the Similarity</strong>
                    <p>Determine whether the reports refer to the same event or separate incidents.</p>
                </div>
            </div>

            <div class="vs-guideline-item">
                <span class="vs-guideline-icon">03</span>
                <div>
                    <strong>Record the Decision</strong>
                    <p>Mark the report as a confirmed duplicate or a unique incident after review.</p>
                </div>
            </div>

        </div>

    </section>

@endsection
