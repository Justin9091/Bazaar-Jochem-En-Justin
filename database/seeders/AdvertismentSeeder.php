<?php

namespace Database\Seeders;

use App\Models\Advertisment\Advertisment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdvertismentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Advertisment::factory()->count(64)->create();
    }
}
