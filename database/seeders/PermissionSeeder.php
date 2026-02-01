<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
 use App\Models\Permission;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
        // public function run()
        // {
        //     Permission::firstOrCreate([
        //         'name' => 'apply loan',
        //         'guard_name' => 'web',
        //     ], [
        //         'module' => 'loan',
        //         'lable' => 'Apply Loan',
        //         'is_active' => 1,
        //         'description' => 'User can apply for loan'
        //     ]);
        // }

        public function run()
{
    $permissions = [
        [
            'name' => 'apply loan',
            'module' => 'loan',
            'lable' => 'Apply Loan',
            'description' => 'User can apply for loan',
        ],
        [
            'name' => 'view loans',
            'module' => 'loan',
            'lable' => 'View Loans',
            'description' => 'User can view loans',
        ],
        [
            'name' => 'approve loan',
            'module' => 'loan',
            'lable' => 'Approve Loan',
            'description' => 'Admin can approve loans',
        ],
        [
            'name' => 'reject loan',
            'module' => 'loan',
            'lable' => 'Reject Loan',
            'description' => 'Admin can reject loans',
        ],
        [
            'name' => 'disburse loan',
            'module' => 'loan',
            'lable' => 'Disburse Loan',
            'description' => 'Admin can disburse loans',
        ],
    ];

    foreach ($permissions as $perm) {
        Permission::firstOrCreate(
            [
                'name' => $perm['name'],
                'guard_name' => 'web',
            ],
            [
                'module' => $perm['module'],
                'lable' => $perm['lable'],
                'is_active' => 1,
                'description' => $perm['description'],
            ]
        );
    }
}


}
