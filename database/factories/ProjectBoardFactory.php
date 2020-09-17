<?php

namespace Database\Factories;

use App\ProjectBoard;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProjectBoardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProjectBoard::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(25),
            'description' => $this->faker->text(100),
            'abbreviation' => $this->faker->regexify('[A-Z]{4}'),
        ];
    }
}
