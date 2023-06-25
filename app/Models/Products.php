<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'product_id',        
    ];
    protected $primaryKey = 'product_id';

    protected $with = [
        'Category'
    ];

    protected $casts = [
        'images_product' => 'array'
    ];


    public function Category()
    {
        return $this->belongsTo(Category::class);
    }
}
