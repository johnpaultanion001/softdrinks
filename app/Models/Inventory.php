<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    public $table = 'inventories';

    protected $fillable = [
        'category_id',
        'purchase_order_number_id',
        'name',

        'stock',
        'pcs',

        'size',

        'purchase_amount',
        'profit',
        'price',
        
        'total_amount_purchase',
        'total_profit',
        'total_price',

        'expiration',
        'note',

        'isRemove'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function purchase_order()
    {
        return $this->belongsTo(PurchaseOrder::class, 'purchase_order_number_id');
    }
    
}
