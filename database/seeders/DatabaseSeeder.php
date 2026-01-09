<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
     
       $this->call([
            RolePermissionSeeder::class,
            SuperAdminSeeder::class,
        ]);

//     User::factory()->create([
//     'name' => 'Super Admin',
//     'email' => 'superadmin@outlook.com',
//     'password' => Hash::make('password123'),
// ]);

//  $this->command->info('Super Adimin seeded successfully.');
//     }
}
}