<?php

namespace App\Console\Commands;

use App\Models\Retention;
use App\Models\SIS;
use Illuminate\Console\Command;

class DeleteAwardees extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:awardees';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It deletes SIS model or parse data';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $record = Retention::where('id', '1')->first();
        if ($record->duration == 'Months') {
            SIS::where('created_at', '<', now()->subMonths($record->period))
                ->delete();
        } else if ($record->duration == 'Years') {
            SIS::where('created_at', '<', now()->subYears($record->period))
                ->delete();
        } else {
            SIS::where('created_at', '<', now()->subDays($record->period))
                ->delete();
        }
    }
}
