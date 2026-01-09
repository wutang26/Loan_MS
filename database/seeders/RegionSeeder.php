<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         $regions = [
            'Arusha',
            'Dar es Salaam',
            'Dodoma',
            'Geita',
            'Iringa',
            'Kagera',
            'Katavi',
            'Kigoma',
            'Kilimanjaro',
            'Lindi',
            'Manyara',
            'Mara',
            'Mbeya',
            'Mjini Magharibi',
            'Morogoro',
            'Mtwara',
            'Mwanza',
            'Njombe',
            'Pwani',
            'Rukwa',
            'Ruvuma',
            'Shinyanga',
            'Simiyu',
            'Singida',
            'Songwe',
            'Tabora',
            'Tanga',
            'Kaskazini Pemba',
            'Kusini Pemba',
            'Kaskazini Unguja',
            'Kusini Unguja',
        ];

         foreach ($regions as $name) {
            Region::firstOrCreate(['name' => $name]);
        }

        $this->command->info('Tanzania regions seeded successfully.');
    }
}
