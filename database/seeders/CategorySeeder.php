<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'ด้านคอมพิวเตอร์และเครือข่าย',
                'description' => 'ปัญหาเกี่ยวกับคอมพิวเตอร์และระบบเครือข่าย'
            ],
            [
                'name' => 'ด้านระบบสารสนเทศ',
                'description' => 'ปัญหาเกี่ยวกับระบบสารสนเทศต่างๆ'
            ],
            [
                'name' => 'ด้านระบบสื่อสารและอาคารสถานที่',
                'description' => 'ปัญหาเกี่ยวกับระบบสื่อสารและอาคารสถานที่'
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
