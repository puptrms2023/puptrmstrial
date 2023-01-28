<?php

namespace Database\Seeders;

use App\Models\Retention;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DataRetentionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $d = [

            [
                'name' => 'CSV - Parse Data',
                'period' => '1',
                'duration' => 'Years',
            ],
            [
                'name' => 'Archives - Award Applicants',
                'period' => '1',
                'duration' => 'Years',
            ],
            [
                'name' => 'Recognition Records',
                'period' => '1',
                'duration' => 'Years',
            ],
            [
                'name' => 'Activity Log',
                'period' => '30',
                'duration' => 'Days',
            ],
            [
                'name' => 'Notification',
                'period' => '1',
                'duration' => 'Years',
            ],
        ];
        foreach ($d as $key => $data) {
            Retention::create($data);
        }
    }
}
