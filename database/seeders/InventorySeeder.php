<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Inventory;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inventories = [
            //category 1
            [
                'id'    => '1',
                'category_id' => '1',
                'name' => 'Coke Cola',
                'stock' => '40',
                'size' => '1 Liter',
                'description' => '',
                'price' => '350',
                'expiration' => '2021-12-01',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                
            ],   
            [
                'id'    => '2',
                'category_id' => '1',
                'name' => 'Sprite',
                'stock' => '40',
                'size' => '500 ML',
                'description' => '',
                'price' => '150',
                'expiration' => '2021-12-01',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                
            ], 
            [
                'id'    => '3',
                'category_id' => '1',
                'name' => 'Royal',
                'stock' => '40',
                'size' => '1.5 Liters',
                'description' => '',
                'price' => '450',
                'expiration' => '2021-12-01',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                
            ],
            [
                'id'    => '4',
                'category_id' => '1',
                'name' => 'RC',
                'stock' => '40',
                'size' => '1.5 Liters',
                'description' => '',
                'price' => '450',
                'expiration' => '2021-04-08',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                
            ], 
            [
                'id'    => '5',
                'category_id' => '1',
                'name' => 'Soda',
                'stock' => '40',
                'size' => '1.5 Liters',
                'description' => '',
                'price' => '450',
                'expiration' => '2021-04-02',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                
            ],        
        ];

        Inventory::insert($inventories);

    }
}
