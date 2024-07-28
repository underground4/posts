<?php

namespace App\Http\Controllers\API\V1\Product;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Service\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ProductController extends CoreController
{
    protected static $routePrefix = 'product';

    public static function routers(): void
    {
        Route::group(
            [
                'prefix' => static::$routePrefix,
            ],
            function () {
                Route::get('', [self::class, 'index']);

                Route::post('', [self::class, 'store']);

                Route::get('/{productId}', [self::class, 'show']);
            }
        );
    }

    public function index()
    {
        $products = (new ProductService())->getProducts();

        return $this->responseSuccess($products);
    }

    public function show($productId)
    {
        $product = (new ProductService())->getProductById($productId);

        return $this->responseSuccess($product);
    }

    public function store(ProductStoreRequest $request)
    {
        $product = (new ProductService())->createProduct($request);

        return $this->responseSuccess($product->id);
    }
}
