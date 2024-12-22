<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TicketStatus;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TicketStatus>
 */
class TicketStatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = TicketStatus::class;

    public function definition()
    {
        static $order = 1;
        return [
            'name' => $this->faker->unique()->word(),  // ใช้ unique() สำหรับชื่อ
            'label' => $this->faker->word(),
            'color' => $this->faker->randomElement(['primary', 'warning', 'success', 'danger']),
            'order' => $order++
        ];
    }
}
