<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use App\Models\Crime;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminCrimeController extends Controller
{
    public function dashboard(): View
    {
        $pending = Crime::query()->where('status', 'pending')->count();
        $approved = Crime::query()->where('status', 'approved')->count();
        $rejected = Crime::query()->where('status', 'rejected')->count();
        $published = Crime::query()->where('status', 'approved')->whereNotNull('latitude')->whereNotNull('longitude')->count();

        $recent = Crime::query()
            ->with('barangay')
            ->latest()
            ->take(8)
            ->get();

        return view('cp.victoria-safe.dashboard', compact(
            'pending', 'approved', 'rejected', 'published', 'recent'
        ));
    }

    public function crimeRequests(): View
    {
        $crimes = Crime::query()
            ->with('barangay')
            ->latest()
            ->get();

        $counts = [
            'total' => $crimes->count(),
            'pending' => $crimes->where('status', 'pending')->count(),
            'approved' => $crimes->where('status', 'approved')->count(),
            'rejected' => $crimes->where('status', 'rejected')->count(),
        ];

        return view('cp.victoria-safe.pages.crime-requests', compact('crimes', 'counts'));
    }

    public function approve(Crime $crime): RedirectResponse
    {
        $crime->update(['status' => 'approved']);

        return back()->with('status', 'Crime report approved.');
    }

    public function reject(Crime $crime): RedirectResponse
    {
        $crime->update(['status' => 'rejected']);

        return back()->with('status', 'Crime report rejected.');
    }

    public function duplicateReview(): View
    {
        $crimes = Crime::query()
            ->with('barangay')
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('cp.victoria-safe.pages.duplicate-review', compact('crimes'));
    }

    public function approvedIncidents(): View
    {
        $crimes = Crime::query()
            ->with('barangay')
            ->where('status', 'approved')
            ->latest()
            ->get();

        return view('cp.victoria-safe.pages.approved-incidents', compact('crimes'));
    }

    public function crimeMap(): View
    {
        $crimes = Crime::query()
            ->with('barangay')
            ->where('status', 'approved')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->latest()
            ->get();

        $missing = Crime::query()
            ->where('status', 'approved')
            ->where(function ($query) {
                $query->whereNull('latitude')->orWhereNull('longitude');
            })
            ->count();

        return view('cp.victoria-safe.pages.crime-map', compact('crimes', 'missing'));
    }

    public function analytics(): View
    {
        $crimes = Crime::query()
            ->where('status', 'approved')
            ->with('barangay')
            ->get();

        $total = $crimes->count();
        $thisMonth = $crimes->filter(fn (Crime $crime) => $crime->date?->isCurrentMonth())->count();
        $highRiskAreas = $crimes->where('risk_level', 'high')->pluck('barangay_id')->unique()->count();
        $monitoredAreas = $crimes->pluck('barangay_id')->filter()->unique()->count();

        $typeDistribution = $crimes
            ->groupBy(fn (Crime $crime) => $crime->type ?: 'Unspecified')
            ->map(fn ($items, $type) => ['type' => $type, 'count' => $items->count()])
            ->sortByDesc('count')
            ->values();

        $areaComparison = $crimes
            ->groupBy(fn (Crime $crime) => $crime->barangay?->name ?? 'Unassigned')
            ->map(fn ($items, $name) => ['name' => $name, 'count' => $items->count()])
            ->sortByDesc('count')
            ->values();

        return view('cp.victoria-safe.pages.analytics', compact(
            'total', 'thisMonth', 'highRiskAreas', 'monitoredAreas', 'typeDistribution', 'areaComparison'
        ));
    }
}
