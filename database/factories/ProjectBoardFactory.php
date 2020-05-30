<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\ProjectBoard;
use Faker\Generator as Faker;

$factory->define(ProjectBoard::class, function (Faker $faker) {
    return [
        'name' => $faker->text(25),
        'description' => $faker->text(100),
    ];
});
