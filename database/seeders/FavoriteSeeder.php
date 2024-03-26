<?php

namespace Database\Seeders;

use App\Models\advertisement\Advertisement;
use App\Models\User;
use App\Models\UserFavorite;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Make for every user 30 random favorite
        User::all()->each(function ($user) {
            $randomAds = Advertisement::inRandomOrder()->limit(5)->get();

            $randomAds->each(function ($ad) use ($user) {
                UserFavorite::create([
                    'user_id' => $user->id,
                    'advertisement_id' => $ad->id
                ]);
            });
        });
    }
}
