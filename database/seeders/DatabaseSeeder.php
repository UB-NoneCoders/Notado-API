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
        // DB::table('roles')->insert([
        //     ['id' => 1, 'title' => 'Administrador'],
        //     ['id' => 2, 'title' => 'Professor'],
        //     ['id' => 3, 'title' => 'Aluno'],
        // ]);

        Role::create([
            'title' => 'Administrador',
        ]);

        Role::create([
            'title' => 'Professor',
        ]);

        Role::create([
            'title' => 'Aluno',
        ]);
    }
}
