<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'saler',
        'total',
        'modal',
        'profit',
        'tanggal',
    ];

    // customizing date format, $casts is a must 
    // protected $casts = [
    //     'created_at' => 'datetime:d-m-Y H:i'
    // ];
}
