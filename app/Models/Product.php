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
        'base_price',
        'discount_first',
        'discount_second',
        'quantity_shop',
        'quantity_warehouse',
        'location_id',
        'category_id',
        'brand_id',
        'supplier_id',
        'date_input',
        'sold'
    ];
}
