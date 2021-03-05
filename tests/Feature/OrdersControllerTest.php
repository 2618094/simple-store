<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Shipping;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrdersControllerTest extends TestCase
{
    use DatabaseMigrations;
    use WithFaker;

    public function testCreateOrder()
    {
        $product = Product::factory()->create();
        $shipping = Shipping::factory()->create();
        $params = [
            'shipping_id' => $shipping->id,
            'product_id' => $product->id,
            'client_name' => $this->faker->name,
            'client_address' => $this->faker->address,
        ];
        $this->post(route('orders.store'), $params)
            ->assertRedirect();
    }
}
