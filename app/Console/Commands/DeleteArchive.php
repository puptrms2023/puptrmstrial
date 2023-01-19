<?php

namespace App\Console\Commands;

use App\Models\AcademicExcellence;
use App\Models\NonAcademicApplicant;
use App\Models\Retention;
use App\Models\StudentApplicant;
use Illuminate\Console\Command;

class DeleteArchive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:archive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete Archves Award Application';

    /**
     * Execute the console command.
     *
     * @return int
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
        // echo $record;
    }
}
