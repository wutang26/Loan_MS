<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
  /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $districts = [
            ['region_id' => 1, 'name' => 'Ilala'],
            ['region_id' => 1, 'name' => 'Kinondoni'],
            ['region_id' => 1, 'name' => 'Temeke'],
            ['region_id' => 2, 'name' => 'Arusha'],
            ['region_id' => 2, 'name' => 'Meru'],
            ['region_id' => 2, 'name' => 'Monduli'],
            ['region_id' => 3, 'name' => 'Dodoma Urban'],
            ['region_id' => 3, 'name' => 'Bahi'],
            ['region_id' => 3, 'name' => 'Chamwino'],
            ['region_id' => 4, 'name' => 'Mwanza Urban'],
            ['region_id' => 4, 'name' => 'Sengerema'],
            ['region_id' => 4, 'name' => 'Ukerewe'],
            ['region_id' => 5, 'name' => 'Mbeya Urban'],
            ['region_id' => 5, 'name' => 'Chunya'],
            ['region_id' => 5, 'name' => 'Mbeya Rural'],
            ['region_id' => 6, 'name' => 'Mtwara Urban'],
            ['region_id' => 6, 'name' => 'Masasi'],
            ['region_id' => 6, 'name' => 'Nanyumbu'],
            ['region_id' => 7, 'name' => 'Morogoro Urban'],
            ['region_id' => 7, 'name' => 'Kilombero'],
            ['region_id' => 7, 'name' => 'Kilosa'],
            ['region_id' => 8, 'name' => 'Kigoma Urban'],
            ['region_id' => 8, 'name' => 'Kasulu'],
            ['region_id' => 8, 'name' => 'Kakonko'],
            // Add more districts as needed
        ];

        DB::table('districts')->insert($districts);
    }
}
