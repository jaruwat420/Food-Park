<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $departments = [
            [
                'name' => 'ฝ่ายการตลาด',
                'description' => 'Marketing Department'
            ],
            [
                'name' => 'ฝ่ายบัญชี',
                'description' => 'Accounting Department'
            ],
            [
                'name' => 'ฝ่ายไอที',
                'description' => 'IT Department'
            ],
            [
                'name' => 'ฝ่ายขาย',
                'description' => 'Sales Department'
            ],
            [
                'name' => 'ฝ่ายบุคคล',
                'description' => 'HR Department'
            ],
            [
                'name' => 'ฝ่ายพัฒนาธุรกิจ',
                'description' => 'Business Development'
            ]
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}
