<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::truncate();

        Role::insert([
            [
                'role_code' => 'root'
            ],
            [
                'role_code' => 'admin'
            ],
            [
                'role_code' => 'visitor'
            ]
        ]);
    }
}
