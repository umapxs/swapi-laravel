<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Film;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Film>
 */
class FilmFactory extends Factory
{
    protected $model = Film::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'episode_id' => $this->faker->unique()->numberBetween(1, 100),
            // 'opening_crawl' => $this->faker->paragraph(),
            'director' => $this->faker->name(),
            'producer' => $this->faker->name(),
            'release_date' => $this->faker->date(),
            // 'characters' => [],
            // 'planets' => [],
            // 'starships' => [],
            // 'vehicles' => [],
            // 'species' => [],
            // 'created' => $this->faker->dateTime(),
            // 'edited' => $this->faker->dateTime(),
            // 'url' => $this->faker->url(),
        ];
    }
}
