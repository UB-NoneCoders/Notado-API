<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->count(100)
            ->state(["role_id" => 1])
            ->create();

        User::factory()
            ->count(5)
            ->state(["role_id" => 2])
            ->create();

        User::factory()
            ->count(2)
            ->state(["role_id" => 3])
            ->create();
    }
}
