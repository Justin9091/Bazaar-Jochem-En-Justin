<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Update or insert
        Property::updateOrCreate(['key' => 'primary-color', 'value' => 'red']);
        Property::updateOrCreate(['key' => 'primary-opacity', 'value' => '400']);
        Property::updateOrCreate(['key' => 'text-color', 'value' => 'neutral']);
        Property::updateOrCreate(['key' => 'text-opacity', 'value' => '50']);
        Property::updateOrCreate(['key' => 'secondary-text-color', 'value' => 'slate']);
        Property::updateOrCreate(['key' => 'secondary-text-opacity', 'value' => '950']);
        Property::updateOrCreate(['key' => 'background-color', 'value' => 'slate']);
        Property::updateOrCreate(['key' => 'background-opacity', 'value' => '600']);
        Property::updateOrCreate(['key' => 'border-radius', 'value' => 'rounded-lg']);
        Property::updateOrCreate(['key' => 'shadow', 'value' => 'shadow-lg']);
        Property::updateOrCreate(['key' => 'padding', 'value' => 'p-4']);
        Property::updateOrCreate(['key' => 'margin', 'value' => 'm-4']);
    }
}
