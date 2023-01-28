<?php

namespace App\Jobs;

use App\Models\Audit;
use App\Models\Retention;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ActivityLogDeleteJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $record = Retention::where('id', '4')->first();
        if ($record->duration == 'Months') {
            Audit::where('created_at', '<', now()->subMonths($record->period))
                ->delete();
        } else if ($record->duration == 'Years') {
            Audit::where('created_at', '<', now()->subYears($record->period))
                ->delete();
        } else {
            Audit::where('created_at', '<', now()->subDays($record->period))
                ->delete();
        }
    }
}
