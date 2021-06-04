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
        $invs = [
            [
                'id'    => '1',
                'category_id'    => '1',
                'purchase_order_number_id' => '1',
                'name' => 'Coke',
                'stock' => '200',
                'qty' => '200',
                'size_id' => '1',
                'sales' => '0',
                'expiration' => '2021-07-24',
                'purchase_amount' => '400',
                'profit' => '50',
                'price' => '450',
                'total_amount_purchase' => '79200',
                'total_profit' => '9900',
                'total_price' => '89100',
                'note' => 'sample',
                'isRemove' => '0',
                'product_number' => '1622720357-1',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'id'    => '2',
                'category_id'    => '3',
                'purchase_order_number_id' => '1',
                'name' => 'Coke in Can',
                'stock' => '200',
                'qty' => '200',
                'size_id' => '6',
                'sales' => '0',
                'expiration' => '2021-07-24',

                'purchase_amount' => '20',
                'profit' => '5',
                'price' => '25',

                'total_amount_purchase' => '4000',
                'total_profit' => '1000',
                'total_price' => '5000',

                'note' => 'sample',
                'isRemove' => '0',
                'product_number' => '1622720279-1',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],

            [
                'id'    => '3',
                'category_id'    => '1',
                'purchase_order_number_id' => '1',
                'name' => 'Mountain Dew',
                'stock' => '20',
                'qty' => '20',
                'size_id' => '2',
                'sales' => '0',
                'expiration' => '2021-07-24',

                'purchase_amount' => '500',
                'profit' => '100',
                'price' => '600',

                'total_amount_purchase' => '10000',
                'total_profit' => '2000',
                'total_price' => '12000',

                'note' => 'sample',
                'isRemove' => '0',
                'product_number' => '1622720208-1',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
           
        ];

        Inventory::insert($invs);

    }
}
