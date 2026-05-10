<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventTypesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('event_types')->insert([
            [
                'burrial_celemon' => 'Burial Ceremony',
                'child_birth'     => 'Child Birth',
                'wedding'         => 'Wedding',
                'sickness'        => 'Sickness',
                'accident'        => 'Accident',
                'school_support'  => 'School Support',
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now(),
            ]
        ]);
    }
}
