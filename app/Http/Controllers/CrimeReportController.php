<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use App\Models\Crime;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CrimeReportController extends Controller
{
    public function create(): View
    {
        $barangays = Barangay::query()->orderBy('name')->get(['id', 'name']);

        return view('crime-reports.create', compact('barangays'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'type' => ['required', 'string', 'in:theft,robbery,assault,burglary,vandalism,other'],
            'description' => ['required', 'string', 'max:2000'],
            'date' => ['required', 'date', 'before_or_equal:today'],
            'barangay_id' => ['nullable', 'integer', 'exists:barangays,id'],
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
        ]);

        $crime = Crime::create([
            ...$validated,
            'type' => ucfirst($validated['type']),
            'risk_level' => 'monitored',
            'status' => 'pending',
        ]);

        return to_route('crime-reports.create')
            ->with('report_reference', $crime->id);
    }
}
