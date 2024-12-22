<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WhyChooseUsTitleSeeder extends Seeder
{
    public function run()
    {
        DB::table('section_titles')->insert([
            [
                'key' => 'why_choose_top_title',
                'value' => 'why choose us',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'key' => 'why_choose_main_title',
                'value' => 'why choose us',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'key' => 'why_choose_sub_title',
                'value' => 'why choose us why choose us why choose us why choose us why choose us why choose us why choose us why choose us why choose us why choose us v why choose usv why choose us',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
