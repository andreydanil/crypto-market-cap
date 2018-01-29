<?php

namespace App\Console\Commands;

use App\Library\CurrencyRates;
use Carbon\Carbon;
use DB;
use Illuminate\Console\Command;

class UpdateCurrencyRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coin:currency';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update fiat currency exchange rates';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws \Exception
     */
    public function handle()
    {
        $baseCurrency = 'USD'; // TODO: fetch from settings
        $api = new CurrencyRates();
        $rates = $api->latest($baseCurrency);

        foreach (array_merge($rates->getBaseRate(), $rates->getRates()) as $symbol => $rate) {
            $symbol = strtoupper($symbol);
            DB::table('currencies')->updateOrInsert(
                ['symbol' => $symbol,],
                [
                    'symbol' => $symbol,
                    'rate' => floatval($rate),
                    'last_updated' => Carbon::now()
                ]
            );
        }

        $this->info('Updated currency exchange rates');
    }
}
