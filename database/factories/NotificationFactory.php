<?php

use Faker\Generator as Faker;
use App\Models\Notification;

$factory->define(Notification::class, function (Faker $faker) {
    return [
        'user_send_id' => rand(1, 10),
        'user_receive_id' => rand(1, 10),
        'target_id' => rand(1, 10),
        'viewed' => rand(0, 1),
        'notification_type' => $faker->randomElement($array = array('call', 'seminar')),
        'notification_id' => rand(1, 10),
    ];
});
