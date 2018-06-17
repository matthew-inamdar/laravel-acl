<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'super admin', 'guard_name' => 'api']);
        Role::create(['name' => 'event organiser', 'guard_name' => 'api']);
    }
}
