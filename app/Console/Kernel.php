<?php

namespace App\Console;

use App\Models\RegosSync;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('sync:getSessionId')->everyTenMinutes();

        $schedule->command('sync:getCountry')->everyTenMinutes();
        $schedule->command('sync:getBrand')->everyTenMinutes();
        $schedule->command('sync:getItemGroup')->everyTenMinutes();

        $schedule->command('sync:getItem')->everyTenMinutes();
        $schedule->command('sync:getItemPrice')->everyTenMinutes();
        $schedule->command('sync:getItemCurrentQuantity')->everyTenMinutes();

        $schedule->command('sync:getPromoProgram')->everyTenMinutes();
        $schedule->command('sync:getPromoProgramSetting')->everyTenMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
