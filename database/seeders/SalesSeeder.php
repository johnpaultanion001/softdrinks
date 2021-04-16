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
                'created_at' => ("2021-04-15"),
                'updated_at' => date("Y-m-d H:i:s"),
                
            ],   
            [
                'id'    => '2',
                'inventory_id' => '1',
                'purchase_qty' => '5',
                'total' => '1750',
                'status' => '0',
                'created_at' => ("2021-04-15"),
                'updated_at' => date("Y-m-d H:i:s"),
            ], 
            [
                'id'    => '3',
                'inventory_id' => '1',
                'purchase_qty' => '5',
                'total' => '1750',
                'status' => '0',
                'created_at' => ("2021-04-16"),
                'updated_at' => date("Y-m-d H:i:s"),
                
            ],
            [
                'id'    => '4',
                'inventory_id' => '1',
                'purchase_qty' => '5',
                'total' => '1750',
                'status' => '0',
                'created_at' => ("2021-04-17"),
                'updated_at' => date("Y-m-d H:i:s"),
                
            ], 
            [
                'id'    => '5',
                'inventory_id' => '1',
                'purchase_qty' => '5',
                'total' => '1750',
                'status' => '0',
                'created_at' => ("2021-04-17"),
                'updated_at' => date("Y-m-d H:i:s"),
                
            ],     
            [
                'id'    => '6',
                'inventory_id' => '1',
                'purchase_qty' => '5',
                'total' => '1750',
                'status' => '0',
                'created_at' => ("2021-01-17"),
                'updated_at' => date("Y-m-d H:i:s"),
                
            ],     
            [
                'id'    => '7',
                'inventory_id' => '1',
                'purchase_qty' => '5',
                'total' => '1750',
                'status' => '0',
                'created_at' => ("2020-04-17"),
                'updated_at' => date("Y-m-d H:i:s"),
                
            ],     
            [
                'id'    => '8',
                'inventory_id' => '1',
                'purchase_qty' => '5',
                'total' => '1750',
                'status' => '0',
                'created_at' => ("2021-03-17"),
                'updated_at' => date("Y-m-d H:i:s"),
                
            ],     
            [
                'id'    => '9',
                'inventory_id' => '1',
                'purchase_qty' => '5',
                'total' => '1750',
                'status' => '0',
                'created_at' => ("2021-03-17"),
                'updated_at' => date("Y-m-d H:i:s"),
                
            ],     
            [
                'id'    => '10',
                'inventory_id' => '1',
                'purchase_qty' => '5',
                'total' => '1750',
                'status' => '0',
                'created_at' => ("2020-04-17"),
                'updated_at' => date("Y-m-d H:i:s"),
                
            ],
            [
                'id'    => '11',
                'inventory_id' => '1',
                'purchase_qty' => '0',
                'total' => '0',
                'status' => '0',
                'created_at' => ("2020-04-18"),
                'updated_at' => date("Y-m-d H:i:s"),
                
            ],  
            [
                'id'    => '12',
                'inventory_id' => '1',
                'purchase_qty' => '5',
                'total' => '3500',
                'status' => '0',
                'created_at' => ("2020-04-18"),
                'updated_at' => date("Y-m-d H:i:s"),
                
            ],  
            [
                'id'    => '13',
                'inventory_id' => '1',
                'purchase_qty' => '0',
                'total' => '0',
                'status' => '0',
                'created_at' => ("2020-04-24"),
                'updated_at' => date("Y-m-d H:i:s"),
                
            ],  
            [
                'id'    => '14',
                'inventory_id' => '1',
                'purchase_qty' => '5',
                'total' => '1750',
                'status' => '0',
                'created_at' => ("2020-04-23"),
                'updated_at' => date("Y-m-d H:i:s"),
                
            ],  
            [
                'id'    => '15',
                'inventory_id' => '1',
                'purchase_qty' => '0',
                'total' => '0',
                'status' => '0',
                'created_at' => ("2020-04-22"),
                'updated_at' => date("Y-m-d H:i:s"),
                
            ],  
            [
                'id'    => '16',
                'inventory_id' => '1',
                'purchase_qty' => '0',
                'total' => '0',
                'status' => '0',
                'created_at' => ("2020-04-21"),
                'updated_at' => date("Y-m-d H:i:s"),
                
            ],  
            [
                'id'    => '17',
                'inventory_id' => '1',
                'purchase_qty' => '0',
                'total' => '0',
                'status' => '0',
                'created_at' => ("2020-04-20"),
                'updated_at' => date("Y-m-d H:i:s"),
                
            ],  
            [
                'id'    => '18',
                'inventory_id' => '1',
                'purchase_qty' => '0',
                'total' => '0',
                'status' => '0',
                'created_at' => ("2020-04-19"),
                'updated_at' => date("Y-m-d H:i:s"),
                
            ],  
            [
                'id'    => '19',
                'inventory_id' => '1',
                'purchase_qty' => '0',
                'total' => '0',
                'status' => '0',
                'created_at' => ("2020-04-18"),
                'updated_at' => date("Y-m-d H:i:s"),
                
            ],  
            [
                'id'    => '20',
                'inventory_id' => '1',
                'purchase_qty' => '5',
                'total' => '1750',
                'status' => '0',
                'created_at' => ("2019-04-18"),
                'updated_at' => date("Y-m-d H:i:s"),
                
            ],  

        ];

        Sales::insert($sales);
    }
}
