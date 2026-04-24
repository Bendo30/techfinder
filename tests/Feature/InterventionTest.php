<?php

namespace Tests\Feature;

use App\Models\Competence;
use App\Models\Intervention;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InterventionTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    public function test_intervention_list():void{
        $response = $this->get('/api/interventions');
        $response->assertStatus(200);
    }

    public function test_intervention_creation(): void
    {
        $interventionData = Intervention::factory()->make()->toArray();
        $response = $this->post('/api/interventions', $interventionData);
        $response->assertStatus(201);
        $this->assertDatabaseHas('interventions', ['title' => 'Test Intervention']);
    }

}
