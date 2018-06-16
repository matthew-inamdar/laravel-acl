<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Event::class, function (Faker $faker) {
    $events = ['Freshers Party', 'Quids In', 'SIC', 'Apple Bum'];

    return [
        'space_id' => function () {
            return factory(\App\Models\Space::class)->create()->id;
        },
        'name' => $events[array_rand($events)],
        'start_at' => now()->setTime(20, 0),
        'duration_in_minutes' => 240,
    ];
});
