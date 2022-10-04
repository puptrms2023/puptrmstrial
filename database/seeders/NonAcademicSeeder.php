<?php

namespace Database\Seeders;

use App\Models\Non_Acad_Award;
use App\Models\NonAcadAward;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NonAcademicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Leadership Award',
            'Athlete of the Year Award',
            'Outstanding Organization Award',
            'Best Thesis Award',
            'Graduating Organization Presidents',
            'Graduating Student Assistants',
            'Outside Competitions',
            'Graduating member of PUPT Dance Troupe',
            'Graduating member of PUPT Choral Group (CHANTERS)',
        ];

        foreach ($data as $non_acad) {
            NonAcadAward::create(['name' => $non_acad]);
        }
    }
}
