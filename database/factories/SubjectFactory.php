<?php

namespace Database\Factories;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Subject::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),          // Nome fictício para a coluna 'name'
            'status' => $this->faker->boolean(),     // Status como true/false (ativo/inativo)
            'teacher_id' => 2,  
        ];
    }
}
