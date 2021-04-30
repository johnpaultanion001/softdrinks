<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;


class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $suppliers = [
            [
                'id'    => 1,
                'Name' => 'Coca Cola Company',
                'address' => 'Antipolo Branch',
                'contact' => '1234567423',
                'note' => 'Monday Morning',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                
            ],
            [
                'id'    => 2,
                'Name' => 'Sprite Company',
                'address' => 'Pasig Branch',
                'contact' => '1234567423',
                'note' => 'Tuesday Morning',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
        ];

        Supplier::insert($suppliers);
    }
}
