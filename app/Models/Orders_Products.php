<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders_Products extends Model
{
    use HasFactory;
    protected $with = [
        'ProductsInfo'
    ];
    public function ProductsInfo()
    {
        return $this->hasOne(Products::class, 'id', 'product_id');
    }
}
