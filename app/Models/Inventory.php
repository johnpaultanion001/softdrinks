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
        'name',
        'stock',
        'description',
        'size',
        'price',
        'sales',
        'expiration'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
