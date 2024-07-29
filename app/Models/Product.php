<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'sub_category_id',
        'name',
        'amount',
        'discount_amount',
        'tags',
        'size_id',
        'stock',
        'available_stock',
        'stock_sell',
        'details',
        'image',
        'is_related',
        'is_new_arrival',
        'is_popular',
        'is_customized',
        'status',
    ];


}
