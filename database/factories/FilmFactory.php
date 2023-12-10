<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Film>
 */
class FilmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create('fr_FR');

        return [
            'titre' => $faker->sentence(3),
            'realisateur' => $faker->name(),
            'pays' => $faker->country(),
            'date_sortie' => $faker->date(),
            'description' => $faker->paragraph(),
            'poster' => $faker->imageUrl(),
            'duree' => $faker->numberBetween(60, 180),
            'langue' => $faker->languageCode(),
        ];
    }
}
