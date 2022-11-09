<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        User::insert([
            [
                'name' => 'Ceyhun Bezos',
                'email' => 'ceyhun@example.com',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Ferhat Musk',
                'email' => 'ferhat@example.com',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'Ercan Gates',
                'email' => 'ercan@example.com',
                'password' => Hash::make('password')
            ]
        ]);
    }
}
