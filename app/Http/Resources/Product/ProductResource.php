<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public $resource;

    public function toArray($request): array
    {
        return [
            'name' => $this->name,
            'price' => $this->price,
            'image' => ProductImageResource::make($this->whenLoaded('main_image')) ?? '',
        ];
    }
}
