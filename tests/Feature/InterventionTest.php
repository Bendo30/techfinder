<?php

namespace Tests\Feature;

use App\Models\Competence;
use App\Models\Intervention;
use App\Models\Utilisateur;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InterventionTest extends TestCase
{
    use RefreshDatabase;

    public function test_intervention_list():void{
        $response = $this->get('/api/interventions');
        $response->assertStatus(200);
    }

    public function test_intervention_creation(): void
    {
        // Créer les dépendances nécessaires
        $client = Utilisateur::factory()->create();
        $technicien = Utilisateur::factory()->create();
        $competence = Competence::factory()->create();

        // Créer les données d'intervention avec les IDs créés
        $interventionData = [
            'date_int' => now()->format('Y-m-d'),
            'note_int' => 5,
            'commentaire_int' => 'Test intervention',
            'code_user_client' => $client->code_user,
            'code_user_techn' => $technicien->code_user,
            'code_comp' => $competence->code_comp,
        ];

        $response = $this->post('/api/interventions', $interventionData);
        $response->assertStatus(201);
        $this->assertDatabaseHas('intervention', [
            'code_user_client' => $interventionData['code_user_client'],
            'code_user_techn' => $interventionData['code_user_techn'],
            'code_comp' => $interventionData['code_comp']
        ]);
    }

    public function test_intervention_show(): void
    {
        // Créer les dépendances nécessaires
        $client = Utilisateur::factory()->create();
        $technicien = Utilisateur::factory()->create();
        $competence = Competence::factory()->create();

        // Créer une intervention
        $intervention = Intervention::create([
            'date_int' => now()->format('Y-m-d'),
            'note_int' => 4,
            'commentaire_int' => 'Test intervention show',
            'code_user_client' => $client->code_user,
            'code_user_techn' => $technicien->code_user,
            'code_comp' => $competence->code_comp,
        ]);

        $response = $this->get("/api/interventions/{$intervention->code_int}");
        $response->assertStatus(200);
        $response->assertJson([
            'code_int' => $intervention->code_int,
            'commentaire_int' => 'Test intervention show',
        ]);
    }

    public function test_intervention_update(): void
    {
        // Créer les dépendances nécessaires
        $client = Utilisateur::factory()->create();
        $technicien = Utilisateur::factory()->create();
        $competence = Competence::factory()->create();

        // Créer une intervention
        $intervention = Intervention::create([
            'date_int' => now()->format('Y-m-d'),
            'note_int' => 3,
            'commentaire_int' => 'Intervention initiale',
            'code_user_client' => $client->code_user,
            'code_user_techn' => $technicien->code_user,
            'code_comp' => $competence->code_comp,
        ]);

        // Données de mise à jour
        $updatedData = [
            'date_int' => now()->format('Y-m-d'),
            'note_int' => 5,
            'commentaire_int' => 'Intervention mise à jour',
            'code_user_client' => $client->code_user,
            'code_user_techn' => $technicien->code_user,
            'code_comp' => $competence->code_comp,
        ];

        $response = $this->put("/api/interventions/{$intervention->code_int}", $updatedData);
        $response->assertStatus(200);
        $this->assertDatabaseHas('intervention', [
            'code_int' => $intervention->code_int,
            'commentaire_int' => 'Intervention mise à jour',
            'note_int' => 5,
        ]);
    }

    public function test_intervention_deletion(): void
    {
        // Créer les dépendances nécessaires
        $client = Utilisateur::factory()->create();
        $technicien = Utilisateur::factory()->create();
        $competence = Competence::factory()->create();

        // Créer une intervention
        $intervention = Intervention::create([
            'date_int' => now()->format('Y-m-d'),
            'note_int' => 3,
            'commentaire_int' => 'Intervention à supprimer',
            'code_user_client' => $client->code_user,
            'code_user_techn' => $technicien->code_user,
            'code_comp' => $competence->code_comp,
        ]);

        $response = $this->delete("/api/interventions/{$intervention->code_int}");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('intervention', [
            'code_int' => $intervention->code_int,
        ]);
    }

    public function test_intervention_search(): void
    {
        // Créer les dépendances nécessaires
        $client = Utilisateur::factory()->create();
        $technicien = Utilisateur::factory()->create();
        $competence = Competence::factory()->create();

        // Créer plusieurs interventions
        $intervention1 = Intervention::create([
            'date_int' => now()->format('Y-m-d'),
            'note_int' => 5,
            'commentaire_int' => 'Réparation urgente du système',
            'code_user_client' => $client->code_user,
            'code_user_techn' => $technicien->code_user,
            'code_comp' => $competence->code_comp,
        ]);

        $intervention2 = Intervention::create([
            'date_int' => now()->format('Y-m-d'),
            'note_int' => 3,
            'commentaire_int' => 'Maintenance préventive',
            'code_user_client' => $client->code_user,
            'code_user_techn' => $technicien->code_user,
            'code_comp' => $competence->code_comp,
        ]);

        $intervention3 = Intervention::create([
            'date_int' => now()->format('Y-m-d'),
            'note_int' => 4,
            'commentaire_int' => 'Installation de nouveaux équipements',
            'code_user_client' => $client->code_user,
            'code_user_techn' => $technicien->code_user,
            'code_comp' => $competence->code_comp,
        ]);

        $response = $this->get('/api/interventions/search?query=Réparation');
        $response->assertStatus(200);
        $response->assertJsonFragment(['commentaire_int' => 'Réparation urgente du système']);
        $response->assertJsonMissing(['commentaire_int' => 'Maintenance préventive']);
    }

}
