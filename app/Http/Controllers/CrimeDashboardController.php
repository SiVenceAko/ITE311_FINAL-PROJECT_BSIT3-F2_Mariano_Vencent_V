<?php

namespace App\Http\Controllers;

use App\Models\Crime;
use Illuminate\Support\Collection as SupportCollection;
use Statamic\Facades\GlobalSet;

class CrimeDashboardController extends Controller
{
    public function map()
    {
        $crimes = Crime::query()
            ->where('status', 'approved')
            ->with('barangay')
            ->orderByDesc('date')
            ->orderByDesc('id')
            ->get();

        $crimeTypes = $crimes
            ->pluck('type')
            ->filter()
            ->unique()
            ->sort()
            ->values();

        $crimeMapContent = GlobalSet::findByHandle('crime_map')?->inDefaultSite();

        return view('crime-map', compact('crimes', 'crimeTypes', 'crimeMapContent'));
    }

    public function analytics()
    {
        $crimes = Crime::query()
            ->where('status', 'approved')
            ->with('barangay')
            ->orderByDesc('date')
            ->orderByDesc('id')
            ->get();

        $totalCrimes = $crimes->count();
        $riskCounts = [
            'high' => $crimes->where('risk_level', 'high')->count(),
            'moderate' => $crimes->where('risk_level', 'moderate')->count(),
            'monitored' => $crimes->where('risk_level', 'monitored')->count(),
        ];
        $riskPercentages = collect($riskCounts)
            ->map(fn (int $count) => $totalCrimes === 0 ? 0 : $count / $totalCrimes * 100)
            ->all();

        $crimeTypeDistribution = $crimes
            ->groupBy(fn (Crime $crime) => $crime->type ?: 'Unspecified')
            ->map(fn (SupportCollection $incidents, string $type) => [
                'type' => $type,
                'count' => $incidents->count(),
                'percentage' => $totalCrimes === 0
                    ? 0
                    : round($incidents->count() / $totalCrimes * 100, 2),
            ])
            ->sortByDesc('count')
            ->values();

        $areaComparison = $crimes
            ->groupBy(fn (Crime $crime) => $crime->barangay?->name ?? 'Unassigned')
            ->map(function (SupportCollection $incidents, string $area): array {
                $riskPriority = ['monitored' => 1, 'moderate' => 2, 'high' => 3];
                $highestRisk = $incidents
                    ->pluck('risk_level')
                    ->sortByDesc(fn (string $risk) => $riskPriority[$risk] ?? 0)
                    ->first();

                return [
                    'name' => $area,
                    'count' => $incidents->count(),
                    'risk_level' => isset($riskPriority[$highestRisk ?? ''])
                        ? $highestRisk
                        : 'monitored',
                ];
            })
            ->sortByDesc('count')
            ->values();

        $dailyTrend = $crimes
            ->filter(fn (Crime $crime) => $crime->date !== null)
            ->groupBy(fn (Crime $crime) => $crime->date->format('Y-m-d'))
            ->sortKeys()
            ->take(-4)
            ->map(fn (SupportCollection $incidents, string $date) => [
                'date' => $incidents->first()->date->format('M d'),
                'count' => $incidents->count(),
            ])
            ->values();

        $maxDailyCount = max(1, (int) $dailyTrend->max('count'));
        $dateRange = $crimes->pluck('date')->filter();
        $periodLabel = $dateRange->isEmpty()
            ? 'No dates available'
            : ($dateRange->min()->format('M Y') === $dateRange->max()->format('M Y')
                ? $dateRange->min()->format('F Y')
                : $dateRange->min()->format('M Y').' – '.$dateRange->max()->format('M Y'));

        $analyticsContent = GlobalSet::findByHandle('analytics')?->inDefaultSite();

        return view('analytics-dashboard', compact(
            'totalCrimes',
            'riskCounts',
            'riskPercentages',
            'crimeTypeDistribution',
            'areaComparison',
            'dailyTrend',
            'maxDailyCount',
            'periodLabel',
            'analyticsContent',
        ));
    }
}
