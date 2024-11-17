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
            for ($bimonthly = 1; $bimonthly < 5; $bimonthly++) {
                for ($test = 1; $test < 5; $test++) {
                    DB::table("tests")->insert([
                        "name" => "Teste " . strval($test),
                        "bimonthly" => $bimonthly,
                        "maximum_score" => 10,
                        "subject_id" => $subject->id,
                    ]);
                }
            }
        }
    }
}
