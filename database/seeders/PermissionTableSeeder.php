<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            // 'menu-send-certificate',
            // 'menu-activity-log',
            // 'calendar-create',
            // 'calendar-edit',
            // 'calendar-delete',
            // 'menu-calendar',
            // 'gallery-create',
            // 'gallery-edit',
            // 'gallery-delete',
            // 'photo-list',
            // 'photo-create',
            // 'photo-edit',
            // 'photo-delete',
            // 'menu-gallery',
            // 'menu academic awards'
            // 'menu utilities'
            'student list',
            'student edit',
            'student delete'

        ];

        foreach ($data as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
