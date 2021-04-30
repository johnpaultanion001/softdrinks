<?php

namespace Database\Seeders;
use App\Models\PurchaseOrder;

use Illuminate\Database\Seeder;

class PurchaseOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $purchaseorder = [
            [
                'id'    => '1',
                'user_id' => '1',
                'purchase_order_number' => '1',
                'supplier_id' => '1',
                'total_purchased_order' => '0',
                'total_profit' => '0',
                'total_price' => '0',
                'total_orders' => '0',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
           
            
        ];

        PurchaseOrder::insert($purchaseorder);
    }
}
