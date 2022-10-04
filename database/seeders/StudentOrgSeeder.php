<?php

namespace Database\Seeders;

use App\Models\StudentOrganization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentOrgSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'AECES',
            'JMA',
            'JPIA',
            'JPMAP',
            'CS',
            'JPSME',
            'PASOA',
            'MS',
        ];

        foreach ($data as $org) {
            StudentOrganization::create(['name' => $org]);
        }
    }
}
