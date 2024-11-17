<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = User::where('role_id', '=', 1)->pluck('id')->toArray();
        $teachers = User::where('role_id', '=', 2)->pluck('id')->toArray();

        $teacherIndex = 0;
        foreach (["Linguagens", "Ciências Humanas", "Ciências da Natureza", "Matemática", "Redação"] as $name) {
            DB::table("subjects")->insert([
                'name' => $name,          // Nome fictício de matéria para a coluna 'name'
                'status' => 1,     // Status como true/false (ativo/inativo)
                'teacher_id' => $teachers[$teacherIndex],
            ]);

            $teacherIndex++;
        }

        foreach (Subject::all() as $subject) {
            $subject->addStudent($students);
        }
    }
}
