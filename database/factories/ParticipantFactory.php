<?php

use Faker\Generator as Faker;
use App\Models\Participant;

$factory->define(Participant::class, function (Faker $faker) {
    return [
        'seminar_id' => rand(1, 20),
        'user_id' => rand(1, 10),
        'status' => rand(0, 1),
    ];
});
