<?php

namespace Database\Seeders;

use App\Models\Advertisment\Advertisment;
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
            $randomAds = Advertisment::inRandomOrder()->limit(5)->get();

            $randomAds->each(function ($ad) use ($user) {
                UserFavorite::create([
                    'user_id' => $user->id,
                    'advertisment_id' => $ad->id
                ]);
            });
        });
    }
}
