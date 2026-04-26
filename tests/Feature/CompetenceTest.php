<?php

namespace Tests\Feature;

use App\Models\Competence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompetenceTest extends TestCase
{
    use RefreshDatabase;

    //methode pour tester la liste des competences
    public function test_competence_list():void{
        $response = $this->get('/api/competences');
        $response->assertStatus(200);
    }

    //methode pour la création d'une competence
    public function test_competence_creation(): void
    {
        $competenceData = Competence::factory()->make()->toArray();
        $response = $this->post('/api/competences', $competenceData);
        $response->assertStatus(201);
    }

    //methode pour afficher une competence
    public function test_competence_show(): void
    {
        $competence = Competence::factory()->create();
        $response = $this->get("/api/competences/{$competence->code_comp}");
        $response->assertStatus(200);
        $response->assertJson([
            'code_comp' => $competence->code_comp,
            'label_comp' => $competence->label_comp,
        ]);
    }

    //methode pour la mise à jour d'une competence
    public function test_competence_update(): void
    {
        $competence = Competence::factory()->create();
        $updatedData = Competence::factory()->make()->toArray();
        $response = $this->put("/api/competences/{$competence->code_comp}", $updatedData);
        $response->assertStatus(200);
        $this->assertDatabaseHas('competences', ['label_comp' => $updatedData['label_comp']]);
    }

    //methode pour la suppression d'une competence
    public function test_competence_deletion(): void
    {
        $competence = Competence::factory()->create();

        $response = $this->delete("/api/competences/{$competence->code_comp}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('competences', ['code_comp' => $competence->code_comp]);
    }

    //methode pour la recherche d'une competence
    public function test_competence_search(): void
    {
        $competence1 = Competence::factory()->create(['label_comp' => 'PHP Development']);
        $competence2 = Competence::factory()->create(['label_comp' => 'JavaScript Programming']);
        $competence3 = Competence::factory()->create(['label_comp' => 'Python Scripting']);

        $response = $this->get('/api/competences/search?query=PHP');
        $response->assertStatus(200);
        $response->assertJsonFragment(['label_comp' => 'PHP Development']);
        $response->assertJsonMissing(['label_comp' => 'JavaScript Programming']);
    }
}
