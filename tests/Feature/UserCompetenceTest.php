<?php

namespace Tests\Feature;

use App\Models\Competence;
use App\Models\UserCompetence;
use App\Models\Utilisateur;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserCompetenceTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_competence_list():void{
        $response = $this->get('/api/user-competence');

        $response->assertStatus(200);
    }

    public function test_user_competence_creation(): void
    {
        // Créer les dépendances nécessaires
        $utilisateur = Utilisateur::factory()->create();
        $competence = Competence::factory()->create();

        $userCompetenceData = [
            'code_user' => $utilisateur->code_user,
            'code_comp' => $competence->code_comp,
        ];

        $response = $this->post('/api/user-competence', $userCompetenceData);
        $response->assertStatus(201);
        $this->assertDatabaseHas('user_competence', [
            'code_user' => $utilisateur->code_user,
            'code_comp' => $competence->code_comp,
        ]);
    }

    public function test_user_competence_show(): void
    {
        // Créer les dépendances nécessaires
        $utilisateur = Utilisateur::factory()->create();
        $competence = Competence::factory()->create();

        // Créer une relation user-competence
        $userCompetence = UserCompetence::create([
            'code_user' => $utilisateur->code_user,
            'code_comp' => $competence->code_comp,
        ]);

        $response = $this->get("/api/user-competence/{$utilisateur->code_user}/{$competence->code_comp}");
        $response->assertStatus(200);
        $response->assertJson([
            'code_user' => $utilisateur->code_user,
            'code_comp' => $competence->code_comp,
        ]);
    }

    public function test_user_competence_update(): void
    {
        // Créer les dépendances nécessaires
        $utilisateur = Utilisateur::factory()->create();
        $competence1 = Competence::factory()->create();
        $competence2 = Competence::factory()->create();

        // Créer une relation user-competence
        UserCompetence::create([
            'code_user' => $utilisateur->code_user,
            'code_comp' => $competence1->code_comp,
        ]);

        // Données de mise à jour
        $updatedData = [
            'code_user' => $utilisateur->code_user,
            'code_comp' => $competence2->code_comp,
        ];

        $response = $this->put("/api/user-competence/{$utilisateur->code_user}/{$competence1->code_comp}", $updatedData);
        $response->assertStatus(200);
    }

    public function test_user_competence_deletion(): void
    {
        // Créer les dépendances nécessaires
        $utilisateur = Utilisateur::factory()->create();
        $competence = Competence::factory()->create();

        // Créer une relation user-competence
        UserCompetence::create([
            'code_user' => $utilisateur->code_user,
            'code_comp' => $competence->code_comp,
        ]);

        $response = $this->delete("/api/user-competence/{$utilisateur->code_user}/{$competence->code_comp}");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('user_competence', [
            'code_user' => $utilisateur->code_user,
            'code_comp' => $competence->code_comp,
        ]);
    }
}
