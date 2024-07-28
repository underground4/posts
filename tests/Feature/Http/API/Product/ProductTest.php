<?php

namespace Tests\Feature\Http\API\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    public function testUnauthorizationUserCanNotMakeRequest()
    {
        $route = route('product.index');
        $this->withHeaders(['accept' => 'application/json'])->get($route)->assertStatus(401);

        $route = route('product.show');
        $this->withHeaders(['accept' => 'application/json'])->get($route)->assertStatus(401);

        $route = route('product.store');
        $this->withHeaders(['accept' => 'application/json'])->post($route)->assertStatus(401);
    }

    public function testPaginateProduct()
    {
        $route = route('product.index');

        $response = $this->get($route);
        $response->assertStatus(200);
    }

    public function testShowProduct()
    {
        $route = route('product.show');

        $response = $this->get($route);
        $response->assertStatus(200);
    }

    public function testStoreProduct()
    {
        $route = route('product.store', [
            'name' => 'test',
            'description' => 'test',
            'price' => 4324324
        ]);

        $response = $this->post($route);
        $response->assertStatus(200);
    }
}
