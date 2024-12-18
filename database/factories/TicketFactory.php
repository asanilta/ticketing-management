<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition()
    {
        $ticket = [
            'created_at' => $this->faker->dateTimeBetween('-2 months'),
            'user_id' => User::role('customer')->inRandomOrder()->first()->id,
            'agent_id' => User::role('agent')->inRandomOrder()->first()->id,
            'status' => $this->faker->randomElement(['Opened', 'In Progress', 'On Hold', 'Closed']),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->text(),
        ];
        if ($ticket['status'] == 'Closed') {
            $ticket['closed_at'] = Carbon::instance($this->faker->dateTimeBetween($ticket['created_at'], 'now'));
        }
        return $ticket;
    }
}
