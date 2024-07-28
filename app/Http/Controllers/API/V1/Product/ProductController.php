<?php

namespace App\Http\Controllers\API\V1\Product;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Resources\Product\ProductResource;
use App\Service\ProductService;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
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
                Route::get('', [self::class, 'index'])
                    ->name('product.index');

                Route::post('', [self::class, 'store'])
                    ->name('product.store');

                Route::get('/{productId}', [self::class, 'show'])
                    ->name('product.show');
            }
        );
    }

    public function index(Request $request)
    {
        $page = $request->input('page') ?? 1;
        $perPage = 10;
        $relation = $request->input('relation') ?? [];

        $countProducts = (new ProductService())->getProductCount();
        $products = (new ProductService())->getProducts($relation, $page, $perPage);

        $products = ProductResource::collection($products);
        $productsPaginated = new LengthAwarePaginator($products, $countProducts, $perPage, $page);

        return $this->responseSuccess($productsPaginated);
    }

    public function show($productId)
    {
        $product = (new ProductService())->getProductById($productId);

        return $this->responseSuccess(ProductResource::make($product));
    }

    public function store(ProductStoreRequest $request)
    {
        $product = (new ProductService())->createProduct($request);

        return $this->responseSuccess($product->id);
    }
}
