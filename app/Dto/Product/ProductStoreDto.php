<?php

namespace App\Dto\Product;

class ProductStoreDto
{
    public function __construct(
        public string $name,
        public string $description,
        public string $price,
    )
    {
    }

    public function toArray()
    {
        return (array) $this;
    }
}
