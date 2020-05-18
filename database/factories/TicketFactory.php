<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Ticket;
use Faker\Generator as Faker;

$factory->define(Ticket::class, function (Faker $faker) {
    $prio = rand(0, 4);
    $status = rand(0, 4);

    return [
        'subject' => $faker->text(100),
        'description' => $faker->paragraph(15),
        'priority' => ['minimal', 'minor', 'major', 'urgent', 'blocker'][$prio],
        'reporter' => $faker->companyEmail,
        'assignee_id' => 1,
        'contact' => $faker->companyEmail,
        'deadline' => $faker->date(),
        'status' => ['Open', 'In Progress', 'QA', 'In Review', 'Closed'][$status],
    ];
});
