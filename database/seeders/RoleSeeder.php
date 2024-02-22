<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Role::where('name', 'individual')->doesntExist()) {
            Role::create(['name' => 'individual']);
        }

        if (Role::where('name', 'business')->doesntExist()) {
            Role::create(['name' => 'business']);
        }
    }
}
