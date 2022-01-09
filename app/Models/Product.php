<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'model',
        'price',
        'discount_price',
        'base_price',
        'quantity_shop',
        'quantity_warehouse',
        'location_id',
        'category_id',
        'brand_id',
        'supplier_id',
        'supplier_model',
        'sold',
        'tanggal_masuk'
    ];
}
