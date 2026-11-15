<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CrimeReportTest extends TestCase
{
    use RefreshDatabase;

    public function test_report_form_renders_location_picker(): void
    {
        $this->get(route('crime-reports.create'))
            ->assertOk()
            ->assertSee('report-location-map', false)
            ->assertSee('Isumite para sa Review');
    }

    public function test_public_report_is_saved_pending_and_hidden_until_approved(): void
    {
        $report = [
            'type' => 'theft',
            'description' => 'A report awaiting staff review.',
            'date' => now()->toDateString(),
            'latitude' => '13.1733849',
            'longitude' => '121.2787746',
        ];

        $response = $this->post(route('crime-reports.store'), $report);

        $response->assertRedirect(route('crime-reports.create'))
            ->assertSessionHas('report_reference');

        $this->assertDatabaseHas('crimes', [
            'type' => 'Theft',
            'description' => $report['description'],
            'latitude' => $report['latitude'],
            'longitude' => $report['longitude'],
            'status' => 'pending',
        ]);

        $this->get(route('crime-map'))
            ->assertOk()
            ->assertDontSee($report['description']);

        $this->get(route('analytics-dashboard'))
            ->assertOk()
            ->assertSee('0 Records');
    }

    public function test_report_requires_valid_details_and_map_coordinates(): void
    {
        $response = $this->from(route('crime-reports.create'))
            ->post(route('crime-reports.store'), [
                'type' => 'unknown-type',
                'description' => '',
                'date' => '2100-01-01',
                'barangay_id' => 999999,
                'latitude' => '200',
                'longitude' => '',
            ]);

        $response->assertRedirect(route('crime-reports.create'))
            ->assertSessionHasErrors([
                'type',
                'description',
                'latitude',
                'longitude',
                'date',
                'barangay_id',
            ]);

        $this->assertDatabaseCount('crimes', 0);
    }
}
