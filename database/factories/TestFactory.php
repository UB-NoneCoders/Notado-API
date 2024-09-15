<?php

namespace Database\Factories;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\test>
 */
class TestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subjects = Subject::all()->pluck('id')->toArray();

        return [
            "name" => fake()->sentence(3),
            "bimonthly" => fake()->numberBetween(1,2),
            "maximum_score" => fake()->numberBetween(1,10),
            "subject_id" => fake()->randomElement($subjects)
        ];
    }
}
