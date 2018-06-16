<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        factory(\App\Models\User::class, 3)->create();

        $venues = factory(\App\Models\Venue::class, 3)->create();

        foreach ($venues as $venue) {
            $spaces = factory(\App\Models\Space::class, 3)->create(['venue_id' => $venue->id]);

            foreach ($spaces as $space) {
                factory(\App\Models\Event::class, 3)->create(['space_id' => $space->id]);
            }
        }
    }
}
