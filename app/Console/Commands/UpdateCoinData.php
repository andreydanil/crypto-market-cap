<?php

namespace App\Console\Commands;

use App\Library\CoinRepository;
use Illuminate\Console\Command;

class UpdateCoinData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coin:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update cryptocurrency data';

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
     * @throws \HttpException
     */
    public function handle()
    {
        CoinRepository::updateCoinData();
        $this->info('Updated coin data.');
    }
}