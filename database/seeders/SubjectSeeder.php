<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subject::create(['name' => 'Hardware Issue']);
        Subject::create(['name' => 'Software Issue']);
        Subject::create(['name' => 'Network Issue']);
        Subject::create(['name' => 'Other']);
    }
}
