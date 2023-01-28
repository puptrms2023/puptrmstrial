<?php

namespace App\Jobs;

use App\Models\Document;
use App\Models\Retention;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class RecognitionDeleteJob implements ShouldQueue
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
        $record = Retention::where('id', '3')->first();
        if ($record->duration == 'Months') {
            Document::where('created_at', '<', now()->subMonths($record->period))
                ->delete();
        } else if ($record->duration == 'Years') {
            Document::where('created_at', '<', now()->subYears($record->period))
                ->delete();
        } else {
            Document::where('created_at', '<', now()->subDays($record->period))
                ->delete();
        }
    }
}
