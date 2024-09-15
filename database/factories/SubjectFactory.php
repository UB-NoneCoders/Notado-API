<?php

namespace Database\Factories;

use App\Models\User;
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
    

    public function definition()
    {
        $teachers = User::where('role_id', '=', 2)->pluck('id')->toArray();
        
        return [
            'name' => $this->faker->word(),          // Nome fictício de matéria para a coluna 'name'
            'status' => $this->faker->boolean(),     // Status como true/false (ativo/inativo)
            'teacher_id' => $this->faker->randomElement($teachers),
        ];
    }
}
