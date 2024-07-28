<?php

namespace App\Service;

use Illuminate\Support\Arr;

class ProductSortingService
{
    public const SORT_CREATED_AT_DESC = 'created_at_desc';

    private static $sortings = [
        [
            'key' => 'price_desc',
            'column' => 'price',
            'direction' => 'desc',
        ],
        [
            'key' => 'price_asc',
            'column' => 'price',
            'direction' => 'asc',
        ],
        [
            'key' => 'created_at_asc',
            'column' => 'created_at',
            'direction' => 'asc',
        ],
        [
            'key' => 'created_at_desc',
            'column' => 'created_at',
            'direction' => 'desc',
        ],
    ];

    public static function getAvailableSortings()
    {
        return self::$sortings;
    }

    public static function getSortingByKey(string $key)
    {
        return Arr::first(self::$sortings, function($sorting) use ($key) {
            return $sorting['key'] === $key;
        });
    }

    public static function getSorting(): array
    {
        return self::getSortingByKey(request('sort') ?? self::SORT_CREATED_AT_DESC);
    }
}
