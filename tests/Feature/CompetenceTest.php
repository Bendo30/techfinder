<?php

namespace Tests\Feature;

use App\Models\Competence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompetenceTest extends TestCase
{
    use RefreshDatabase;
    // public function test_example(): void
    // {
    //     $response = $this->get('/'); //lance une requete en GET sur la route / et demande la confirmation sur le statut 200. Si 200 reussite sinon echec


    //     $response->assertStatus(200); //verfication du statut
    // }


    //methode pour tester la liste des competences
    public function test_competence_list():void{
        $response = $this->get('/api/competences');//lance une requete sur la route api/competences
        $response->assertStatus(200);
    }

    //methode pour la création d'une competence
    public function test_competence_creation(): void
    {
        $competenceData = Competence::factory()->make()->toArray();
        $response = $this->post('/api/competences', $competenceData);
        $response->assertStatus(201);
    }


    //methode pour la mise à jour d'une competence
    public function test_competence_update(): void
    {
        $competence = Competence::factory()->create();
        $updatedData = Competence::factory()->make()->toArray();
        $response = $this->put("/api/competences/{$competence->code_comp}", $updatedData);
        $response->assertStatus(200);
        $this->assertDatabaseHas('competences', ['name' => 'Updated Competence']);
    }


    //methode pour la suppression d'une competence
    public function test_competence_deletion(): void
    {
        $competence = Competence::factory()->create();

        $response = $this->delete("/api/competences/{$competence->code_comp}");

        $response->assertStatus(204);
    }
}
