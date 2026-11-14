<?php

namespace Tests\Feature;

use App\Models\Barangay;
use App\Models\Crime;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CrimeDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_pages_render_without_incident_records(): void
    {
        $this->get(route('crime-map'))
            ->assertOk()
            ->assertSee('No incident records are in the database yet.');

        $this->get(route('analytics-dashboard'))
            ->assertOk()
            ->assertSee('No dates available')
            ->assertSee('No crime records to summarize yet.');
    }

    public function test_crime_map_shows_incidents_from_the_database(): void
    {
        $barangay = Barangay::create(['name' => 'Barangay One']);
        $crime = Crime::create([
            'barangay_id' => $barangay->id,
            'type' => 'Theft',
            'description' => 'Verified test detail',
            'date' => '2026-10-24',
            'risk_level' => 'moderate',
            'latitude' => '13.1733849',
            'longitude' => '121.2787746',
        ]);

        $this->get(route('crime-map'))
            ->assertOk()
            ->assertSee('id="crime-map"', false)
            ->assertSee('Theft')
            ->assertSee('Barangay One')
            ->assertSee('data-id="'.$crime->id.'"', false)
            ->assertSee('data-latitude="13.1733849"', false)
            ->assertSee('data-longitude="121.2787746"', false)
            ->assertSee('Verified test detail');
    }

    public function test_analytics_are_calculated_from_database_incidents(): void
    {
        $barangay = Barangay::create(['name' => 'Barangay Two']);
        Crime::create([
            'barangay_id' => $barangay->id,
            'type' => 'Robbery',
            'description' => 'Test report',
            'date' => '2026-10-24',
            'risk_level' => 'high',
        ]);

        $this->get(route('analytics-dashboard'))
            ->assertOk()
            ->assertSee('Total Records')
            ->assertSee('Robbery')
            ->assertSee('Barangay Two')
            ->assertSee('High Risk');
    }
}
