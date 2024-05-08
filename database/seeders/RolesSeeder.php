<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'role_name' => 'admin'
        ]);
        Role::create([
            'role_name' => 'manger'
        ]);

        Role::create([
            'role_name' => 'guest'
        ]);

        Role::create([
            'role_name' => 'member'
        ]);
    }
}
