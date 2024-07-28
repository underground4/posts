<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

\App\Http\Controllers\API\V1\Product\ProductController::routers();

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
