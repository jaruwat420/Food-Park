<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketSystemSeeder extends Seeder
{
    public function run()
    {
        // สร้าง Categories
        DB::table('categories')->insert([
            [
                'name' => 'ด้านคอมพิวเตอร์และเครือข่าย',
                'description' => 'ปัญหาเกี่ยวกับคอมพิวเตอร์และระบบเครือข่าย',
                'color' => 'success',
                'icon' => 'fas fa-laptop',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'ด้านระบบสารสนเทศ',
                'description' => 'ปัญหาเกี่ยวกับระบบสารสนเทศต่างๆ',
                'color' => 'danger',
                'icon' => 'fas fa-database',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'ด้านระบบ ERP',
                'description' => 'ปัญหาเกี่ยวกับระบบ ERP',
                'color' => 'warning',
                'icon' => 'fas fa-cog',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // สร้าง Status
        DB::table('ticket_statuses')->insert([
            [
                'name' => 'new',
                'label' => 'ใหม่',
                'color' => 'primary',
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'in_progress',
                'label' => 'กำลังดำเนินการ',
                'color' => 'warning',
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'completed',
                'label' => 'เสร็จสิ้น',
                'color' => 'success',
                'order' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'cancelled',
                'label' => 'ยกเลิก',
                'color' => 'danger',
                'order' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
