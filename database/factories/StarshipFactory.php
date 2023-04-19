<?php

namespace Database\Factories;

use App\Models\Starship;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Starship>
 */
class StarshipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Starship::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'model' => $this->faker->word,
            'manufacturer' => $this->faker->word,
            'cost_in_credits' => $this->faker->numberBetween(0, 10000),
            'length' => $this->faker->numberBetween(0, 10000),
            'max_atmosphering_speed' => $this->faker->numberBetween(0, 10000),
            'crew' => $this->faker->numberBetween(0, 10000),
            'passengers' => $this->faker->numberBetween(0, 10000),
            'cargo_capacity' => $this->faker->numberBetween(0, 10000),
            'consumables' => $this->faker->word,
            'hyperdrive_rating' => $this->faker->numberBetween(0, 10),
            'MGLT' => $this->faker->numberBetween(0, 10000),
            'starship_class' => $this->faker->word,
            'pilots' => [],
            'films' => [],
            'created' => $this->faker->date(),
            'edited' => $this->faker->date(),
            'url' => $this->faker->url,
        ];
    }
}
