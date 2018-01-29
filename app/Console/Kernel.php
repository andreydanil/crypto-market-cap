<?php

namespace App\Console;

use App\Console\Commands\UpdateCoinData;
use App\Console\Commands\UpdateCoinNews;
use App\Console\Commands\UpdateCurrencyRates;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        UpdateCurrencyRates::class,
        UpdateCoinData::class,
        UpdateCoinNews::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command(UpdateCurrencyRates::class)
            ->hourly();

        $schedule->command(UpdateCoinData::class)
            ->everyTenMinutes()
            ->withoutOverlapping();

        $schedule->command(UpdateCoinNews::class)
            ->everyThirtyMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
