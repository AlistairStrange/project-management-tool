<?php
namespace Database\Factories;

use App\User;
use App\Ticket;
use App\Comment;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user_id = rand(1, User::all()->count());
        $ticket_id = rand(1, Ticket::all()->count());

        return [
            'content' => $this->faker->paragraph(2),
            'user_id' => $user_id,
            'ticket_id' => $ticket_id,
        ];
    }
}
