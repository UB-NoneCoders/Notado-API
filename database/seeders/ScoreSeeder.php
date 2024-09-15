<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $subjects = Subject::all();
        $students = User::where('role_id', '=', 1)->get();
        
        foreach ($subjects as $subject) {
            $students_subject = fake()->randomElements(
                $students,
                fake()->numberBetween(3,sizeof($students))
            );
            $tests = $subject->tests;

            foreach ($tests as $test) {
                foreach ($students_subject as $student_subject) {
                    DB::table('scores')->insert([
                        "test_score" => fake()->numberBetween(0,$test->maximum_score),
                        "student_id" => $student_subject->id,
                        "subject_id" => $subject->id,
                        "test_id" => $test->id,
                    ]);
                }
            }
        }
    }
}