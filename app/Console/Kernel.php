<?php

namespace App\Console;

use App\Jobs\DeleteRecord;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('delete:awardees')
            ->daily();
        $schedule->command('delete:recognition')
            ->daily();
        $schedule->command('delete:archive')
            ->daily();
        // $schedule->job(new DeleteRecord)->daily();
    }

    protected function scheduleTimezone()
    {
        return 'Asia/Manila';
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
