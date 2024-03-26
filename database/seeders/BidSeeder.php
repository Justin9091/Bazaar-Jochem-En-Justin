<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Pick a random user and a random advertisement and create a bid
        // The bid price should always be higher than the previous bid

        $advertisements = \App\Models\advertisement\Advertisement::all();
        $users = \App\Models\User::all();

        foreach ($advertisements as $advertisement) {
            $amountOfBids = rand(1, 5);

            for ($i = 0; $i < $amountOfBids; $i++) {
                $bid = new \App\Models\Bid();
                $bid->advertisement_id = $advertisement->id;
                $bid->user_id = $users->random()->id;
                $bid->bid = $advertisement->bids->max('bid') + rand(1, 100);
                $bid->save();
            }
        }
    }
}
