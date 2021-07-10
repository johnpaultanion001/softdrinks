<?php

namespace Database\Seeders;
use App\Models\Sales;

use Illuminate\Database\Seeder;

class SalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sales = [
            [
                'id'    => '1',
                'inventory_id' => '1',
                'purchase_qty' => '5',
                'total' => '1750',
                'status' => '0',
                'order_number' => '100001',
                'user_id' => '1',
                'profit' => '100',
                'total_cost' => '1650',
                'created_at' => ("2021-04-15"),
                'updated_at' => date("Y-m-d H:i:s"),
                'customer_id' => 1,
                'pricetype_id' => 1,
                'discounted' => 0,
                
            ],   
            [
                'id'    => '2',
                'inventory_id' => '1',
                'purchase_qty' => '5',
                'total' => '1750',
                'status' => '0',
                'order_number' => '100001',
                'user_id' => '1',
                'profit' => '200',
                'total_cost' => '1550',
                'created_at' => ("2021-04-15"),
                'updated_at' => date("Y-m-d H:i:s"),
                'customer_id' => 1,
                'pricetype_id' => 1,
                'discounted' => 0,
            ], 
            [
                'id'    => '3',
                'inventory_id' => '1',
                'purchase_qty' => '5',
                'total' => '1750',
                'status' => '0',
                'order_number' => '100001',
                'user_id' => '1',
                'profit' => '40',
                'total_cost' => '1710',
                'created_at' => ("2021-04-16"),
                'updated_at' => date("Y-m-d H:i:s"),
                'customer_id' => 1,
                'pricetype_id' => 1,
                'discounted' => 0,
                
            ],
            [
                'id'    => '4',
                'inventory_id' => '1',
                'purchase_qty' => '5',
                'total' => '1750',
                'status' => '0',
                'profit' => '400',
                'total_cost' => '1350',
                'order_number' => '100001',
                'user_id' => '1',
                'created_at' => ("2021-04-17"),
                'updated_at' => date("Y-m-d H:i:s"),
                'customer_id' => 1,
                'pricetype_id' => 1,
                'discounted' => 0,
            ], 
            [
                'id'    => '5',
                'inventory_id' => '1',
                'purchase_qty' => '5',
                'total' => '1750',
                'status' => '0',
                'order_number' => '100001',
                'user_id' => '1',
                'profit' => '30',
                'total_cost' => '1720',
                'created_at' => ("2021-04-17"),
                'updated_at' => date("Y-m-d H:i:s"),
                'customer_id' => 1,
                'pricetype_id' => 1,
                'discounted' => 0,
            ],     
            [
                'id'    => '6',
                'inventory_id' => '1',
                'purchase_qty' => '5',
                'total' => '1750',
                'status' => '0',
                'order_number' => '100001',
                'user_id' => '1',
                'profit' => '120',
                'total_cost' => '1630',
                'created_at' => ("2021-01-17"),
                'updated_at' => date("Y-m-d H:i:s"),
                'customer_id' => 1,
                'pricetype_id' => 1,
                'discounted' => 0,
            ],     
            [
                'id'    => '7',
                'inventory_id' => '1',
                'purchase_qty' => '5',
                'total' => '1750',
                'status' => '0',
                'order_number' => '100001',
                'user_id' => '1',
                'profit' => '1340',
                'total_cost' => '410',
                'created_at' => ("2020-04-17"),
                'updated_at' => date("Y-m-d H:i:s"),
                'customer_id' => 1,
                'pricetype_id' => 1,
                'discounted' => 0,
            ],     
            [
                'id'    => '8',
                'inventory_id' => '1',
                'purchase_qty' => '5',
                'total' => '1750',
                'status' => '0',
                'order_number' => '100001',
                'user_id' => '1',
                'profit' => '110',
                'total_cost' => '1640',
                'created_at' => ("2021-03-17"),
                'updated_at' => date("Y-m-d H:i:s"),
                'customer_id' => 1,
                'pricetype_id' => 1,
                'discounted' => 0,
            ],     
            [
                'id'    => '9',
                'inventory_id' => '1',
                'purchase_qty' => '5',
                'total' => '1750',
                'status' => '0',
                'order_number' => '100001',
                'user_id' => '1',
                'profit' => '130',
                'total_cost' => '1620',
                'created_at' => ("2021-03-17"),
                'updated_at' => date("Y-m-d H:i:s"),
                'customer_id' => 1,
                'pricetype_id' => 1,
                'discounted' => 0,
            ],     
            [
                'id'    => '10',
                'inventory_id' => '1',
                'purchase_qty' => '5',
                'total' => '1750',
                'status' => '0',
                'order_number' => '100001',
                'user_id' => '1',
                'profit' => '150',
                'total_cost' => '1600',
                'created_at' => ("2020-04-17"),
                'updated_at' => date("Y-m-d H:i:s"),
                'customer_id' => 1,
                'pricetype_id' => 1,
                'discounted' => 0,
            ],
            [
                'id'    => '11',
                'inventory_id' => '1',
                'purchase_qty' => '0',
                'total' => '0',
                'status' => '0',
                'order_number' => '100001',
                'user_id' => '1',
                'profit' => '0',
                'total_cost' => '0',
                'created_at' => ("2020-04-18"),
                'updated_at' => date("Y-m-d H:i:s"),
                'customer_id' => 1,
                'pricetype_id' => 1,
                'discounted' => 0,
            ],  
            [
                'id'    => '12',
                'inventory_id' => '1',
                'purchase_qty' => '5',
                'total' => '3500',
                'status' => '0',
                'order_number' => '100001',
                'user_id' => '1',
                'profit' => '500',
                'total_cost' => '3000',
                'created_at' => ("2020-04-18"),
                'updated_at' => date("Y-m-d H:i:s"),
                'customer_id' => 1,
                'pricetype_id' => 1,
                'discounted' => 0,
            ],  
            [
                'id'    => '13',
                'inventory_id' => '1',
                'purchase_qty' => '0',
                'total' => '0',
                'status' => '0',
                'total_cost' => '0',
                'order_number' => '100001',
                'user_id' => '1',
                'profit' => '0',
                'created_at' => ("2020-04-24"),
                'updated_at' => date("Y-m-d H:i:s"),
                'customer_id' => 1,
                'pricetype_id' => 1,
                'discounted' => 0,
            ],  
            [
                'id'    => '14',
                'inventory_id' => '1',
                'purchase_qty' => '5',
                'total' => '1750',
                'status' => '0',
                'order_number' => '100001',
                'user_id' => '1',
                'profit' => '220',
                'total_cost' => '1530',
                'created_at' => ("2020-04-23"),
                'updated_at' => date("Y-m-d H:i:s"),
                'customer_id' => 1,
                'pricetype_id' => 1,
                'discounted' => 0,
            ],  
            [
                'id'    => '15',
                'inventory_id' => '1',
                'purchase_qty' => '0',
                'total' => '4000',
                'status' => '0',
                'order_number' => '100001',
                'user_id' => '1',
                'profit' => '2000',
                'total_cost' => '2000',
                'created_at' => ("2020-04-22"),
                'updated_at' => date("Y-m-d H:i:s"),
                'customer_id' => 1,
                'pricetype_id' => 1,
                'discounted' => 0,
            ],  
            [
                'id'    => '16',
                'inventory_id' => '1',
                'purchase_qty' => '0',
                'total' => '4000',
                'status' => '0',
                'order_number' => '100001',
                'user_id' => '1',
                'profit' => '2000',
                'total_cost' => '2000',
                'created_at' => ("2020-04-21"),
                'updated_at' => date("Y-m-d H:i:s"),
                'customer_id' => 1,
                'pricetype_id' => 1,
                'discounted' => 0,
            ],  
            [
                'id'    => '17',
                'inventory_id' => '1',
                'purchase_qty' => '0',
                'total' => '4000',
                'status' => '0',
                'order_number' => '100001',
                'user_id' => '1',
                'profit' => '2000',
                'total_cost' => '2000',
                'created_at' => ("2020-04-20"),
                'updated_at' => date("Y-m-d H:i:s"),
                'customer_id' => 1,
                'pricetype_id' => 1,
                'discounted' => 0,
            ],  
            [
                'id'    => '18',
                'inventory_id' => '1',
                'purchase_qty' => '0',
                'total' => '4000',
                'status' => '0',
                'order_number' => '100001',
                'user_id' => '1',
                'profit' => '2000',
                'total_cost' => '2000',
                'created_at' => ("2020-04-19"),
                'updated_at' => date("Y-m-d H:i:s"),
                'customer_id' => 1,
                'pricetype_id' => 1,
                'discounted' => 0,
            ],  
            [
                'id'    => '19',
                'inventory_id' => '1',
                'purchase_qty' => '0',
                'total' => '4000',
                'status' => '0',
                'profit' => '2000',
                'total_cost' => '2000',
                'order_number' => '100001',
                'user_id' => '1',

                'created_at' => ("2020-04-18"),
                'updated_at' => date("Y-m-d H:i:s"),
                'customer_id' => 1,
                'pricetype_id' => 1,
                'discounted' => 0,
            ],  
            [
                'id'    => '20',
                'inventory_id' => '1',
                'purchase_qty' => '5',
                'total' => '4000',
                'status' => '0',
                'order_number' => '100001',
                'user_id' => '1',
                'profit' => '2000',
                'total_cost' => '2000',
                'created_at' => ("2019-04-18"),
                'updated_at' => date("Y-m-d H:i:s"),
                'customer_id' => 1,
                'pricetype_id' => 1,
                'discounted' => 0,
            ],  

        ];

        Sales::insert($sales);
    }
}
