<?php

namespace App\Dto\Product;

class ProductStoreDto
{
    public function __construct(
        public string  $name,
        public string $description,
        public int $price,
    )
    {
    }
}
