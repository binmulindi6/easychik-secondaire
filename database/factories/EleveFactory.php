<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Eleve>
 */
class EleveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "matricule" => 'E' . fake()->randomNumber(3, true) . '/' . '2022',
            "nom" => fake()->firstName,
            "prenom" => fake()->lastName,
            "lieu_naissance" => fake()->city,
            "date_naissance" => fake()->date('Y-m-d','now'),
            "nom_pere" => fake()->name('male'),
            "nom_mere" => fake()->name('female'),
            "adresse" => fake()->address,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
