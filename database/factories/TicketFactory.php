<?php

namespace Database\Factories;

use App\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $prio = rand(0, 4);
        $status = rand(0, 4);
        $board = rand(1,4);    

        return [
            'subject' => $this->faker->text(50),
            'description' => $this->faker->paragraph(15),
            'priority' => ['minimal', 'minor', 'major', 'urgent', 'blocker'][$prio],
            'reporter' => $this->faker->companyEmail,
            'assignee_id' => 1,
            'contact' => $this->faker->companyEmail,
            'deadline' => $this->faker->date(),
            'status' => ['Open', 'In Progress', 'QA', 'In Review', 'Closed'][$status],
            'story_points' => $this->faker->numberBetween($min = 1, $max = 5),
            'project_board_id' => $board,
        ];
    }
}
