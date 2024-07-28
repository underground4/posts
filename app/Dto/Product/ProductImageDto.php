<?php

namespace App\Dto\Product;

class ProductImageDto
{
    public function __construct(
        public int $product_id,
        public string $path,
        public int $sort,
    )
    {
    }

    public function toArray()
    {
        return (array) $this;
    }
}
