<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdminUser; // adjust namespace if your AdminUser is elsewhere
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        AdminUser::create([
            'name' => 'admin',
            'username' => 'admin',
            'password' => Hash::make('admin'), // password: admin
            'status' => 1, // if your admin table has status field
        ]);
    }
}
