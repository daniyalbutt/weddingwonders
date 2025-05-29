<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class VenuePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = ['venue','create venue', 'edit venue', 'delete venue'];
        foreach ($permissions as $value) {
            Permission::create([
                'name' => $value
            ]);
        }
        $role = Role::where('name', 'admin')->first();
        $role->givePermissionTo($permissions);
    }
}
