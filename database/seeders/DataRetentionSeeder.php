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
                'name' => 'CSV',
                'period' => '1',
                'duration' => 'Years',
            ],
            [
                'name' => 'Archives - Award Applicants',
                'period' => '1',
                'duration' => 'Years',
            ],
            [
                'name' => 'Undecided',
                'period' => '6',
                'duration' => 'Months',
            ],
            [
                'name' => 'Recognition Records',
                'period' => '30',
                'duration' => 'Days',
            ],
        ];
        foreach ($d as $key => $data) {
            Retention::create($data);
        }
    }
}
