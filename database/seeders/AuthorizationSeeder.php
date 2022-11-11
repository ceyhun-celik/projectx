<?php

namespace Database\Seeders;

use App\Models\Authorization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Authorization::truncate();

        Authorization::insert([
            [
                'user_id' => 1,
                'role_code' => 'root'
            ],
            [
                'user_id' => 2,
                'role_code' => 'root'
            ],
            [
                'user_id' => 3,
                'role_code' => 'visitor'
            ]
        ]);
    }
}
