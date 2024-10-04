<?php

namespace Database\Factories;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Test>
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
        return [
            "name" => fake()->sentence(3),
            "maximum_score" => fake()->numberBetween(1,10),
            "subject_id" => Subject::factory(),
        ];
    }

    public function bimonthly(int $value)
    {
        return $this->state([
            'bimonthly' => $value,
        ]);
}

}
