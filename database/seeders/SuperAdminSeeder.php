<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         // Check if user already exists
        if (!User::where('email', 'superadmin@example.com')->exists()) {
            $user = User::create([
                'name' => 'Super Admin',
                'email' => 'superadmin@example.com',
                'password' => Hash::make('password123'), // use Hash facade
            ]);

            // Assign role if you are using spatie/laravel-permission
            if (method_exists($user, 'assignRole')) {
                $user->assignRole('super-admin');
            }

            $this->command->info('Super Admin created successfully.');
        } else {
            $this->command->info('Super Admin already exists, skipping.');
        }
    }
    }

