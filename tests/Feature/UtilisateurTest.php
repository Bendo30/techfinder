<?php

namespace Tests\Feature;

use App\Models\Utilisateur;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UtilisateurTest extends TestCase
{
    use RefreshDatabase;

    public function test_utilisateur_list():void{
        $response = $this->get('/api/utilisateurs');

        $response->assertStatus(200);
    }

    public function test_utilisateur_creation(): void
    {
        $utilisateurData = [
            'code_user' => 'USR1234',
            'nom_user' => 'Doe',
            'prenom_user' => 'John',
            'login_user' => 'john.doe',
            'password_user' => 'password123',
            'tel_user' => '0123456789',
            'sexe_user' => 'M',
            'role_user' => 'client',
            'etat_user' => 'actif',
        ];

        $response = $this->post('/api/utilisateurs', $utilisateurData);
        $response->assertStatus(201);
        $this->assertDatabaseHas('utilisateurs', [
            'code_user' => $utilisateurData['code_user'],
            'login_user' => $utilisateurData['login_user']
        ]);
    }

    public function test_utilisateur_show(): void
    {
        $utilisateur = Utilisateur::factory()->create();

        $response = $this->get("/api/utilisateurs/{$utilisateur->code_user}");

        $response->assertStatus(200);
        $response->assertJson([
            'code_user' => $utilisateur->code_user,
            'nom_user' => $utilisateur->nom_user,
            'login_user' => $utilisateur->login_user,
        ]);
    }

    public function test_utilisateur_update(): void
    {
        $utilisateur = Utilisateur::factory()->create();

        $updatedData = [
            'nom_user' => 'Updated Nom',
            'prenom_user' => 'Updated Prenom',
            'login_user' => 'updated.login',
            'password_user' => 'newpassword123',
            'tel_user' => '9876543210',
            'sexe_user' => 'F',
            'role_user' => 'technicien',
            'etat_user' => 'actif',
        ];

        $response = $this->put("/api/utilisateurs/{$utilisateur->code_user}", $updatedData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('utilisateurs', [
            'code_user' => $utilisateur->code_user,
            'nom_user' => 'Updated Nom',
            'login_user' => 'updated.login',
        ]);
    }

    public function test_utilisateur_deletion(): void
    {
        $utilisateur = Utilisateur::factory()->create();

        $response = $this->delete("/api/utilisateurs/{$utilisateur->code_user}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('utilisateurs', ['code_user' => $utilisateur->code_user]);
    }
    public function test_utilisateur_search():void{
        $utilisateur1 = Utilisateur::factory()->create(['nom_user' => 'Dupont', 'prenom_user' => 'Jean']);
        $utilisateur2 = Utilisateur::factory()->create(['nom_user' => 'Martin', 'prenom_user' => 'Pierre']);
        $utilisateur3 = Utilisateur::factory()->create(['nom_user' => 'Bernard', 'prenom_user' => 'Paul']);

        $response = $this->get('/api/utilisateurs/search?query=Dupont');
        $response->assertStatus(200);
        $response->assertJsonFragment(['nom_user' => 'Dupont']);
        $response->assertJsonMissing(['nom_user' => 'Martin']);
    }

}
