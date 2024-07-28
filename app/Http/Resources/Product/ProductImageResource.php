<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductImageResource extends JsonResource
{
    public $resource;

    public function toArray($request): array
    {
        return [
            'path' => $this->path,
        ];
    }
}
