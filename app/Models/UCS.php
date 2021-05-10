<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UCS extends Model
{
    use HasFactory;
    protected $fillable = [
        'purchase_order_number_id',
        'inventory_id',
        'ucs',
        'case',
        'isRemove',
        'isPurchase',


    ];

    public function purchase_order()
    {
        return $this->belongsTo(PurchaseOrder::class, 'purchase_order_number_id', 'purchase_order_number');
    }
    public function inventory()
    {
        return $this->belongsTo(Inventory::class,'inventory_id' , 'product_number');
    }

}
