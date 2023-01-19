<?php

namespace App\Console\Commands;

use App\Models\Document;
use App\Models\Retention;
use Illuminate\Console\Command;

class DeleteRecognition extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:recognition';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete Recognition Records';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $record = Retention::where('id', '4')->first();
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
