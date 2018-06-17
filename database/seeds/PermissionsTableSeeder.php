<?php

use App\Enums\Permissions as PermissionsEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (PermissionsEnum::all() as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'api']);
        }
    }
}
