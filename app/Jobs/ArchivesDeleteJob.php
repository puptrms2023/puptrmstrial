<?php

namespace App\Jobs;

use App\Models\Retention;
use Illuminate\Bus\Queueable;
use App\Models\StudentApplicant;
use App\Models\AcademicExcellence;
use App\Models\NonAcademicApplicant;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ArchivesDeleteJob implements ShouldQueue
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
        $record = Retention::where('id', '2')->first();
        if ($record->duration == 'Months') {
            StudentApplicant::where('created_at', '<', now()->subMonths($record->period))
                ->forceDelete();
            NonAcademicApplicant::where('created_at', '<', now()->subMonths($record->period))
                ->forceDelete();
            AcademicExcellence::where('created_at', '<', now()->subMonths($record->period))
                ->forceDelete();
        } else if ($record->duration == 'Years') {
            StudentApplicant::where('created_at', '<', now()->subYears($record->period))
                ->forceDelete();
            NonAcademicApplicant::where('created_at', '<', now()->subYears($record->period))
                ->forceDelete();
            AcademicExcellence::where('created_at', '<', now()->subYears($record->period))
                ->forceDelete();
        } else {
            StudentApplicant::where('created_at', '<', now()->subDays($record->period))
                ->forceDelete();
            NonAcademicApplicant::where('created_at', '<', now()->subDays($record->period))
                ->forceDelete();
            AcademicExcellence::where('created_at', '<', now()->subDays($record->period))
                ->forceDelete();
        }
    }
}
