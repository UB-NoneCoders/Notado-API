<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("users")->insert([
            ["name" => "pessoa1", "email" => "pessoa1@gmail.com", "password" => "12341234", "role_id" => "1"],
            ["name" => "pessoa2", "email" => "pessoa2@gmail.com", "password" => "12341234", "role_id" => "2"],
            ["name" => "pessoa3", "email" => "pessoa3@gmail.com", "password" => "12341234", "role_id" => "3"],
        ]);
    }
}
