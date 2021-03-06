<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReturn extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'model',
        'quantity',
        'price',
        'subtotal',
        'reason',
        'tanggal',
        'checked'
    ];
}
