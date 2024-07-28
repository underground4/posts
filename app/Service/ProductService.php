<?php

namespace App\Service;

use App\Exceptions\NotFoundException;
use App\Models\Product\Product;

class ProductService
{
    public function getProducts()
    {
        $products = Product::query()
            ->with('product_images')
            ->get();

        return $products;
    }

    public function getProductById($productId)
    {
        $product = Product::query()
            ->where('id', $productId)
            ->first();

        if (empty($product)) {
            throw new NotFoundException('Продукт не найден');
        }

        return $product;
    }
}
