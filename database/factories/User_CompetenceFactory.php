<?php

namespace Database\Factories;

use App\Models\Competence;
use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\Utilisateur;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class User_CompetenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code_user'=>$this->faker->randomElement(Utilisateur::pluck('code_user')->toArray()),
            'code_comp'=>$this->faker->randomElement(Competence::pluck('code_comp')->toArray()),
        ];
    }
}
