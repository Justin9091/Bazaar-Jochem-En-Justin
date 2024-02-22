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
        // Pick a random user and a random advertisment and create a bid
        // The bid price should always be higher than the previous bid

        $advertisments = \App\Models\Advertisment\Advertisment::all();
        $users = \App\Models\User::all();

        foreach ($advertisments as $advertisment) {
            $amountOfBids = rand(1, 5);

            for ($i = 0; $i < $amountOfBids; $i++) {
                $bid = new \App\Models\Bid();
                $bid->advertisment_id = $advertisment->id;
                $bid->user_id = $users->random()->id;
                $bid->bid = $advertisment->bids->max('bid') + rand(1, 100);
                $bid->save();
            }
        }
    }
}
