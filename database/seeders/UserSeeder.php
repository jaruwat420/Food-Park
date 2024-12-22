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
    public function run()
    {
        if (!User::where('email', 'admin@chaixi.co.th')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@chaixi.co.th',
                'role' => 'admin',
                'password' => Hash::make('password')
            ]);
        }

        $users = [
            [
                'name' => 'User1',
                'email' => 'user1@chaixi.co.th',
                'role' => 'user',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'User2',
                'email' => 'user2@chaixi.co.th',
                'role' => 'user',
                'password' => Hash::make('password')
            ]
        ];

        foreach ($users as $user) {
            if (!User::where('email', $user['email'])->exists()) {
                User::create($user);
            }
        }
    }
}
