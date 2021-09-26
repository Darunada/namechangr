<?php

namespace App\Console;

use App\Console\Commands\GetPassportKeys;
use App\Jobs\DeleteExpiredFiles;
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
        GetPassportKeys::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //
        // TODO: Note!  Heroku scheduler runs a one-off dyno for each schedule so I am wary about running it every 10 minutes (heroku max)
        // I have configured it to run every hour at :00.  Hopefully that will do
        // But you need to be aware of it at least, don't schedule for other times.
        //

        /**
         * Delete expired files every day
         * We don't need to keep them around past then
         */
        $schedule->call(function () {
            job(new DeleteExpiredFiles());
        })->everyMinute(); // every minute = every time it runs
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
