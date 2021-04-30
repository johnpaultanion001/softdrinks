<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;
    public $table = 'purchase_orders';

    protected $fillable = [
        'user_id',
        'purchase_order_number',
        'supplier_id',
        'total_purchased_order',
        'total_profit',
        'total_price',
        'isReturn',
        'total_orders',
        'notes',
       
    ];
    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'purchase_order_number_id', 'purchase_order_number');
    }
    public function pendingproducts()
    {
        return $this->hasMany(PendingProduct::class, 'purchase_order_number_id', 'purchase_order_number');
    }
    public function returned()
    {
        return $this->hasMany(Returned::class, 'purchase_order_number_id', 'purchase_order_number');
    }
    public function pendingreturnedproducts()
    {
        return $this->hasMany(PendingReturnedProduct::class, 'purchase_order_number_id', 'purchase_order_number');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

}
