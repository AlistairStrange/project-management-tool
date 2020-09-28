<?php

namespace Database\Factories;

use App\User;
use App\Ticket;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        $assignee_id = rand(1, User::all()->count());
        $date = $this->faker->dateTimeThisYear($max = 'now')->format('Y-m-d h:m:s');

        return [
            'subject' => $this->faker->text(50),
            'description' => $this->faker->paragraph(15),
            'priority' => ['minimal', 'minor', 'major', 'urgent', 'blocker'][$prio],
            'reporter' => $this->faker->companyEmail,
            'assignee_id' => $assignee_id,
            'contact' => $this->faker->companyEmail,
            'deadline' => $this->faker->date($min = $date),
            'status' => ['Open', 'In Progress', 'QA', 'In Review', 'Closed'][$status],
            'story_points' => $this->faker->numberBetween($min = 1, $max = 5),
            'project_board_id' => $board,
            'created_at' => $date,
            'updated_at' => $this->faker->dateTimeBetween($date, '+1 week'),
        ];
    }
}
