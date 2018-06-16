<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Space::class, function (Faker $faker) {
    $rooms = ['Room 1', 'Room 2', 'Room 3', 'Room 4', 'Room 5', 'Room 6', 'Red Room', 'Blue Room', 'Green Room', 'Balcony', 'Basement', 'Rooftop'];

    return [
        'venue_id' => function () {
            return factory(\App\Models\Venue::class)->create()->id;
        },
        'name' => $rooms[array_rand($rooms)],
    ];
});
