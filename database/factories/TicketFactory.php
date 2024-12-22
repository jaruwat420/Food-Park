<?php

namespace Database\Factories;

use App\Models\Ticket;
use App\Models\User;
use App\Models\Category;
use App\Models\TicketStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'status_id' => TicketStatus::factory(),
            'priority' => $this->faker->randomElement(['low', 'normal', 'high', 'urgent']),
            'assigned_to' => User::factory()
        ];
    }

    public function newStatus()
    {
        return $this->state(function (array $attributes) {
            return [
                'status_id' => TicketStatus::where('name', 'new')->first()->id
            ];
        });
    }

    public function inProgress()
    {
        return $this->state(function (array $attributes) {
            return [
                'status_id' => TicketStatus::where('name', 'in_progress')->first()->id
            ];
        });
    }

    public function completed()
    {
        return $this->state(function (array $attributes) {
            return [
                'status_id' => TicketStatus::where('name', 'completed')->first()->id
            ];
        });
    }
}
