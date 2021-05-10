<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendingReturnedProduct extends Model
{
    use HasFactory;
    public $table = 'pending_returned_products';

    protected $fillable = [
        'return_id',
        'purchase_order_number_id',
        'name',
        'case',
        'status_id',
        'deposit',
        'note',
        'isRemove',
    ];
    public function return()
    {
        return $this->belongsTo(Returned::class, 'return_id');
    }
    public function status()
    {
        return $this->belongsTo(StatusReturn::class, 'status_id');
    }
    public function purchase_order()
    {
        return $this->belongsTo(PurchaseOrder::class, 'purchase_order_number_id', 'purchase_order_number');
    }
   
}
