<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => '1',
                'title' => 'user_management_access',
            ],
            
            [
                'id'    => '2',
                'title' => 'permission_access',
            ],
            [
                'id'    => '3',
                'title' => 'role_access',
            ],
            [
                'id'    => '4',
                'title' => 'user_access',
            ],
            [
                'id'    => '5',
                'title' => 'dashboard_access',
            ],
            [
                'id'    => '6',
                'title' => 'inventories_access',
            ],
            [
                'id'    => '7',
                'title' => 'ordering_access',
            ],
            [
                'id'    => '8',
                'title' => 'sales_report_access',
            ],
            [
                'id'    => '9',
                'title' => 'report_access',
            ],
            [
                'id'    => '10',
                'title' => 'graph_access',
            ],
            [
                'id'    => '11',
                'title' => 'purchase_order_access',
            ],
            [
                'id'    => '12',
                'title' => 'supplier_access',
            ],
            [
                'id'    => '13',
                'title' => 'returned_access',
            ],
            [
                'id'    => '14',
                'title' => 'status-return_access',
            ],

            

            
            
        ];

        Permission::insert($permissions);

    }
}
