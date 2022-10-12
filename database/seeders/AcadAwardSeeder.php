<?php

namespace Database\Seeders;

use App\Models\AcadAward;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AcadAwardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Achiever\'s Award',
            'Dean\'s List',
            'President\'s List',
            'Academic Excellence'
        ];

        foreach ($data as $org) {
            AcadAward::create(['name' => $org]);
        }
    }
}
