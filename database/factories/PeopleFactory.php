<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\People;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\People>
 */
class PeopleFactory extends Factory
{
    protected $model = People::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'height' => $this->faker->numberBetween(100, 250),
            'mass' => $this->faker->numberBetween(50, 150),
            'hair_color' => $this->faker->colorName,
            'skin_color' => $this->faker->colorName,
            'eye_color' => $this->faker->colorName,
            'birth_year' => $this->faker->numberBetween(0, 1000) . 'BBY',
            'gender' => $this->faker->randomElement(['Male', 'Female', 'N/a', 'Hermaphrodite']),
            // 'homeworld' => $this->faker->word,
            // 'films' => [],
            // 'species' => [],
            // 'vehicles' => [],
            // 'starships' => [],
            // 'created' => $this->faker->dateTime->format('Y-m-d H:i:s'),
            // 'edited' => $this->faker->dateTime->format('Y-m-d H:i:s'),
            // 'url' => $this->faker->url,
        ];
    }
}
