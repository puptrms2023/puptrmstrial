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
            'Reason 1',
            'Reason 2',
            'Reason 3',
        ];

        foreach ($data as $reason) {
            Reason::create(['description' => $reason]);
        }
    }
}
