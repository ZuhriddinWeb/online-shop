<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $with = [
        'Products'
    ];
   

    public function Products()
    {
        return $this->hasOne(Products::class, 'id', 'product_id');
    }
}
