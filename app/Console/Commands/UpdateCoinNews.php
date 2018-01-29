<?php

namespace App\Console\Commands;

use App\Library\NewsRepository;
use Illuminate\Console\Command;

class UpdateCoinNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coin:news';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update cryptocoin news';

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
        NewsRepository::updateNews();
        $this->info('News updated successfully');
    }
}
