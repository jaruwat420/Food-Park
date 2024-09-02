<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::insert([
            'name' => 'Admin',
            'email' => 'admin@chaixi.co.th',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ],
        [
            'name' => 'User',
            'email' => 'user@chaixi.co.th',
            'role' => 'user',
            'password' => Hash::make('password'),
        ],
    );
    }
}
