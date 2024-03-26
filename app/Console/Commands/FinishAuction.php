<?php

namespace App\Console\Commands;

use App\Models\advertisement\Advertisement;
use Illuminate\Console\Command;

class FinishAuction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auction:finish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Finishes all auctions that have ended.";

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = now();

        $ads = Advertisement::whereDate('expires_at', $now->toDateString())->get();

        foreach ($ads as $ad) {
            $highest_bid = $ad->bids->sortByDesc('amount')->first();

            $ad->bought_user_id = $highest_bid->user_id;
            $ad->save();
        }

        return Command::SUCCESS;
    }
}
