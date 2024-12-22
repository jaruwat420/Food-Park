<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Locations;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run()
    {
        Locations::create([
            'name' => 'สำนักงานใหญ่',
            'description' => 'สำนักงานใหญ่'
        ]);

        Locations::create([
            'name' => 'โรงงานคลองหก',
            'description' => 'โรงงานคลองหก'
        ]);

        Locations::create([
            'name' => 'สำนักงานพระรามเก้า',
            'description' => 'สำนักงานพระรามเก้า'
        ]);

        Locations::create([
            'name' => 'ร้านอาหารในเครือ',
            'description' => 'ร้านอาหารในเครือ'
        ]);
    }
}
