<?php

use Faker\Generator as Faker;
use App\Models\Seminar;
use Carbon\Carbon;

$factory->define(Seminar::class, function (Faker $faker) {
    return [
        'user_id' => rand(1, 5),
        'name' => $faker->text($maxNbChars = 50),
        'description' => $faker->text($maxNbChars = 200),
        'start' => Carbon::now()->subDays(rand(1, 5)),
        'end' => Carbon::now()->addDays(rand(1, 5)),
        'code' => str_random(10),
    ];
});
