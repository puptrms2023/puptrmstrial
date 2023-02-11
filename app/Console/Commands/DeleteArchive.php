<?php

namespace App\Console\Commands;

use App\Models\Retention;
use Illuminate\Console\Command;
use App\Models\StudentApplicant;
use App\Models\AcademicExcellence;
use App\Models\NonAcademicApplicant;
use Illuminate\Support\Facades\File;

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
            $academic_award = StudentApplicant::onlyTrashed()->where('created_at', '<', now()->subMonths($record->period))->get();
            foreach ($academic_award as $data) {
                $image_path = public_path() . '/uploads/' . $data->image;

                if (file_exists($image_path)) {
                    File::delete($image_path);
                }

                $data->forceDelete();
            }
            $non_academic = NonAcademicApplicant::onlyTrashed()->where('created_at', '<', now()->subMonths($record->period))->get();
            foreach ($non_academic as $data) {
                $image_path = public_path() . '/uploads/' . $data->image;

                if (file_exists($image_path)) {
                    File::delete($image_path);
                }

                $data->forceDelete();
            }
            $academic_excellence = AcademicExcellence::onlyTrashed()->where('created_at', '<', now()->subMonths($record->period))->get();
            foreach ($academic_excellence as $data) {
                $image_path = public_path() . '/uploads/' . $data->image;

                if (file_exists($image_path)) {
                    File::delete($image_path);
                }

                $data->forceDelete();
            }
        } else if ($record->duration == 'Years') {
            $academic_award = StudentApplicant::onlyTrashed()->where('created_at', '<', now()->subYears($record->period))->get();
            foreach ($academic_award as $data) {
                $image_path = public_path() . '/uploads/' . $data->image;

                if (file_exists($image_path)) {
                    File::delete($image_path);
                }

                $data->forceDelete();
            }
            $non_academic = NonAcademicApplicant::onlyTrashed()->where('created_at', '<', now()->subYears($record->period))->get();
            foreach ($non_academic as $data) {
                $image_path = public_path() . '/uploads/' . $data->image;

                if (file_exists($image_path)) {
                    File::delete($image_path);
                }

                $data->forceDelete();
            }
            $academic_excellence = AcademicExcellence::onlyTrashed()->where('created_at', '<', now()->subYears($record->period))->get();
            foreach ($academic_excellence as $data) {
                $image_path = public_path() . '/uploads/' . $data->image;

                if (file_exists($image_path)) {
                    File::delete($image_path);
                }

                $data->forceDelete();
            }
        } else {
            $academic_award = StudentApplicant::onlyTrashed()->where('created_at', '<', now()->subDays($record->period))->get();
            foreach ($academic_award as $data) {
                $image_path = public_path() . '/uploads/' . $data->image;

                if (file_exists($image_path)) {
                    File::delete($image_path);
                }

                $data->forceDelete();
            }
            $non_academic = NonAcademicApplicant::onlyTrashed()->where('created_at', '<', now()->subDays($record->period))->get();
            foreach ($non_academic as $data) {
                $image_path = public_path() . '/uploads/' . $data->image;

                if (file_exists($image_path)) {
                    File::delete($image_path);
                }

                $data->forceDelete();
            }
            $academic_excellence = AcademicExcellence::onlyTrashed()->where('created_at', '<', now()->subDays($record->period))->get();
            foreach ($academic_excellence as $data) {
                $image_path = public_path() . '/uploads/' . $data->image;

                if (file_exists($image_path)) {
                    File::delete($image_path);
                }

                $data->forceDelete();
            }
        }
    }
}
