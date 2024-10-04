<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $students = User::where('role_id', '=', 1)->pluck('id')->toArray();
    
        Subject::factory()
            ->count(25)
            ->create()
            ->each(function (Subject $subject) use ($students) {
                $subject->addStudent(
                    fake()->randomElements(
                        $students,
                        fake()->numberBetween(3, count($students))
                    )
                );
            });
    }
}
