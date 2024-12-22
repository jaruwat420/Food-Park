<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TicketSubject;
use App\Models\Subject;

class TicketSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $subjects = [
            [
                'name' => 'เครื่องคอมพิวเตอร์ไม่ทำงาน',
                'description' => 'ปัญหาเกี่ยวกับเครื่องคอมพิวเตอร์',
                'category_id' => 1,
                'order' => 1
            ],
            [
                'name' => 'อินเตอร์เน็ตมีปัญหา',
                'description' => 'ปัญหาเกี่ยวกับการเชื่อมต่ออินเตอร์เน็ต',
                'category_id' => 1,
                'order' => 2
            ],
            [
                'name' => 'ติดตั้งโปรแกรม',
                'description' => 'ต้องการติดตั้งโปรแกรมใหม่',
                'category_id' => 1,
                'order' => 3
            ],
            [
                'name' => 'ระบบใช้งานไม่ได้',
                'description' => 'ปัญหาการใช้งานระบบ',
                'category_id' => 1,
                'order' => 4
            ],
            [
                'name' => 'ปัญหาการเชื่อมต่อระหว่างระบบภายนอกและระบบภายใน',
                'description' => 'ปัญหาการเชื่อมต่อระบบ',
                'category_id' => 1,
                'order' => 5
            ],
            [
                'name' => 'อื่นๆ',
                'description' => 'ปัญหาอื่นๆ',
                'category_id' => 1,
                'order' => 6
            ]
        ];

        foreach ($subjects as $subject) {
            TicketSubject::create($subject);
        }
    }
}
