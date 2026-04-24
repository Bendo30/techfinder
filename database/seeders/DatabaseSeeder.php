<?php

namespace Database\Seeders;

use App\Models\Competence;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        

        // $this->call([
        //     CompetenceSeeder::class
        // ]);
        $this->call([
            UtilisateurSeeder::class
        ]);

        // $this->call([
        //     CompetenceSeeder::class
        // ]);

        // $this->call([
        //     InterventionSeeder::class
        // ]);

        // $this->call([
        //     User_CompetenceSeeder::class
        // ]);




        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
