<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;
    public $table = 'sales';

    protected $fillable = [
        'inventory_id',
        'user_id',
        'purchase_qty',
        'profit',
        'total',
        'isRemove',
        'status',
    ];
    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
