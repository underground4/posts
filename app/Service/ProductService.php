<?php

namespace App\Service;

use App\Dto\Product\ProductImageDto;
use App\Dto\Product\ProductStoreDto;
use App\Exceptions\NotFoundException;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Models\Product\Product;
use App\Models\Product\ProductImage;

class ProductService
{
    public function getProducts($relation, $page = 1, $perPage = 10)
    {
        $sorting = ProductSortingService::getSorting();

        $productsQuery = $this->getProductsQuery();

        $productsQuery = $productsQuery->orderBy($sorting['column'], $sorting['direction']);

        $products = $productsQuery
            ->with('main_image')
            ->limit($perPage)
            ->offset(($page - 1) * $perPage)
            ->get();

        return $products;
    }

    public function getProductById($productId)
    {
        $product = Product::query();

        $product = $product->with('main_image')
            ->where('id', $productId)
            ->first();

        if (empty($product)) {
            throw new NotFoundException('Продукт не найден');
        }

        return $product;
    }

    public function createProduct(ProductStoreRequest $request)
    {
        $productStoreDto = new ProductStoreDto(
            name: $request->name,
            description: $request->description,
            price: $request->price
        );

        $product = Product::create($productStoreDto->toArray());

        if (isset($request->images)) {
            foreach ($request->images as $index => $image) {
                $productImage = new ProductImageDto(
                    product_id: $product->id,
                    path: $image,
                    sort: $index + 1
                );

                ProductImage::create($productImage->toArray());
            }
        }

        return $product;
    }

    public function getProductCount()
    {
        return $this->getProductsQuery()->count();
    }

    public function getProductsQuery()
    {
        return Product::query();
    }
}
