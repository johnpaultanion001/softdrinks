<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    public $table = 'suppliers';
    protected $fillable = [
        'name',
        'address',
        'contact',
        'note',
        'isRemove',
    ];

    public function purchaseorders()
    {
        return $this->hasMany(PurchaseOrder::class, 'supplier_id', 'id');
    }
   
}
