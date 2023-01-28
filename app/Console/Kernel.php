<?php

namespace App\Console;

use App\Jobs\ActivityLogDeleteJob;
use App\Jobs\ArchivesDeleteJob;
use App\Jobs\CsvDeleteJob;
use App\Jobs\DeleteRecord;
use App\Jobs\NotificationDeleteJob;
use App\Jobs\RecognitionDeleteJob;
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
        // using jobs
        $schedule->job(new CsvDeleteJob)->daily();
        $schedule->job(new ArchivesDeleteJob)->daily();
        $schedule->job(new RecognitionDeleteJob)->daily();
        $schedule->job(new ActivityLogDeleteJob)->daily();
        $schedule->job(new NotificationDeleteJob)->daily();

        //using commands
        // $schedule->command('delete:awardees')
        //     ->daily();
        // $schedule->command('delete:recognition')
        //     ->daily();
        // $schedule->command('delete:archive')
        //     ->daily();
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
