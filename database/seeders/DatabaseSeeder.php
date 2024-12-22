<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        $this->call([
            UserSeeder::class,
            WhyChooseUsTitleSeeder::class,
            TicketSystemSeeder::class,
            TicketSubjectSeeder::class,
            DepartmentSeeder::class,
            LocationSeeder::class,

        ]);

        \App\Models\Slider::factory(3)->create();
     //   \App\Models\WhyChooseUs::factory(3)->create();
    }
}
