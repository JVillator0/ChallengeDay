<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MetricsTest extends TestCase
{
    public function testAnualAverageFuelConsumptionByCategoryEndpoint()
    {
        $response = $this->get('/api/metrics/anual-average-fuel-consumption-by-category');
        $response->assertStatus(200);
    }

    public function testMonthlyAverageFuelConsumptionEndpoint()
    {
        $response = $this->get('/api/metrics/monthly-average-fuel-consumption');
        $response->assertStatus(200);
    }

    public function testMostImpactSegmentEndpoint()
    {
        $response = $this->get('/api/metrics/most-impact-segment');
        $response->assertStatus(200);
    }

    public function testMonthlyAverageElectricityConsumptionEndpoint()
    {
        $response = $this->get('/api/metrics/monthly-average-electricity-consumption');
        $response->assertStatus(200);
    }

    public function testMonthlyComparisonElectricityFuelConsumptionEndpoint()
    {
        $response = $this->get('/api/metrics/monthly-comparison-electricity-fuel-consumption');
        $response->assertStatus(200);
    }

    public function testMonthlyAverageProductsConsumptionByTypeEndpoint()
    {
        $response = $this->get('/api/metrics/monthly-average-products-consumption-by-type');
        $response->assertStatus(200);
    }

    public function testMonthlyAverageTripsByDepartmentEndpoint()
    {
        $response = $this->get('/api/metrics/monthly-average-trips-by-department');
        $response->assertStatus(200);
    }

    public function testMonthlyConsumptionEndpoint()
    {
        $response = $this->get('/api/metrics/monthly-consumption');
        $response->assertStatus(200);
    }

    public function testGetMonthWithMinimumRefrigerantLossEndpoint()
    {
        $response = $this->get('/api/metrics/get-month-with-minimum-refrigerant-loss');
        $response->assertStatus(200);
    }

    public function testGetMaxMinMonthsUsedFuelEndpoint()
    {
        $response = $this->get('/api/metrics/get-max-min-months-used-fuel');
        $response->assertStatus(200);
    }
}
