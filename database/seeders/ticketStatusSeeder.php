<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TicketStatus;

class ticketStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            [
                'name' => 'new',
                'label' => 'ใหม่',
                'color' => 'primary',
                'order' => 1
            ],
            [
                'name' => 'in_progress',
                'label' => 'กำลังดำเนินการ',
                'color' => 'warning',
                'order' => 2
            ],
            [
                'name' => 'completed',
                'label' => 'เสร็จสิ้น',
                'color' => 'success',
                'order' => 3
            ],
            [
                'name' => 'cancelled',
                'label' => 'ยกเลิก',
                'color' => 'danger',
                'order' => 4
            ]
        ];

        foreach ($statuses as $status) {
            TicketStatus::create($status);
        }
    }
}
