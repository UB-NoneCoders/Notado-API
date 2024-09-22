<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        #Test::factory()->bimonthly(3)->hasProva(5)->create();
        $subjects = Subject::all();

        foreach ($subjects as $subject) {
            for ($i=0; $i < fake()->numberBetween(1,5); $i++) { 
                DB::table("tests")->insert([
                    "name" => fake()->sentence(3),
                    "bimonthly" => 1,
                    "maximum_score" => fake()->numberBetween(1,10),
                    "subject_id" => $subject->id,
                ]);

                DB::table("tests")->insert([
                    "name" => fake()->sentence(3),
                    "bimonthly" => 2,
                    "maximum_score" => fake()->numberBetween(1,10),
                    "subject_id" => $subject->id,
                ]);
            }
        }
    }
}
