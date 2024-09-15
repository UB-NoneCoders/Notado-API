<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            userSeeder::class,
            SubjectSeeder::class,
            TestSeeder::class,
            ScoreSeeder::class,
        ]);
    }
}
