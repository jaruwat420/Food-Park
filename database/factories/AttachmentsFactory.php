<?php

namespace Database\Factories;

use App\Models\Attachments;
use App\Models\Ticket;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AttachmentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Attachments::class;
    public function definition()
    {
        return [
            'ticket_id' => Ticket::factory(),
            'file_name' => $this->faker->word() . '.pdf',
            'file_path' => 'attachments/' . $this->faker->uuid() . '.pdf',
            'file_type' => 'application/pdf'
        ];
    }
}
