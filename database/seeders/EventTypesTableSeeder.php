<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventTypesTableSeeder extends Seeder
{
    public function run(): void
    {
        $eventTypes = [
            'Burial Ceremony',
            'Child Birth',
            'Wedding',
            'Sickness',
            'Accident',
            'School Support'
        ];

        foreach ($eventTypes as $type) {
            DB::table('event_types')->insert([
                'name'       => $type,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}