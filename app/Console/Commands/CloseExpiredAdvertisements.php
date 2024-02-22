<?php

namespace App\Console\Commands;

use App\Models\Advertisment\Advertisment;
use Illuminate\Console\Command;

class CloseExpiredAdvertisements extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bazaar:close-expired-advertisements';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Closed all expired advertisements.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Closing expired advertisements...');
        return Command::SUCCESS;
    }
}
