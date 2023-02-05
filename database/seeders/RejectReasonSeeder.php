<?php

namespace Database\Seeders;

use App\Models\Reason;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RejectReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Others',
            'Incomplete academic requirements',
            'Invalid academic information',
        ];

        foreach ($data as $reason) {
            Reason::create(['description' => $reason]);
        }
    }
}
