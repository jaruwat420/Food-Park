<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WhyChooseUs;
use App\Models\sectionTitle;

class WhyChooseUsTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        sectionTitle::insert([
            [
                'key' => 'why_choose_top_title',
                'value' => 'why choose us',
            ],
            [
                'key' => 'why_choose_main_title',
                'value' => 'why choose us',
            ],
            [
                'key' => 'why_choose_sub_title',
                'value' => 'why choose us why choose us why choose us why choose us why choose us why choose us why choose us  why choose us why choose us why choose us v why choose usv why choose us',
            ]
        ]);
    }
}
