<?php

namespace Tests\Feature;

use App\Models\Utilisateur;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UtilisateurTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    public function test_utilisateur_list():void{
        $response = $this->get('/api/utilisateurs');

        $response->assertStatus(200);
    }

    public function test_utilisateur_creation(): void
    {
        $utilisateurData = Utilisateur::factory()->make()->toArray();
        $response = $this->post('/api/utilisateurs', $utilisateurData);
        $response->assertStatus(201);
    }

    // public function test_utilisateur_update(): void
    // {
    //     $utilisateur = Utilisateur::factory()->create();

    //     $updatedData = [
    //         'name' => 'Updated Utilisateur',
    //         'email' => 'updated@example.com',
    //         'password' => 'updatedpassword',
    //     ];

    //     $response = $this->put("/api/utilisateurs/{$utilisateur->id}", $updatedData);

    //     $response->assertStatus(200);
    //     $this->assertDatabaseHas('users', ['email' => 'updated@example.com']);
    // }

    // public function test_utilisateur_deletion(): void
    // {
    //     $utilisateur = Utilisateur::factory()->create();

    //     $response = $this->delete("/api/utilisateurs/{$utilisateur->id}");
    //     $response->assertStatus(204);
    //     $this->assertDatabaseMissing('users', ['id' => $utilisateur->id]);
    // }

}