<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function product_images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function main_image()
    {
        return $this->hasOne(ProductImage::class)->where('sort', 1);
    }
}
