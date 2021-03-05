<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'total_product_value' => $this->faker->randomDigit,
            'total_shipping_value' => $this->faker->randomDigit,
            'client_name' => $this->faker->name,
            'client_address' => $this->faker->address,
        ];
    }

    public function payed()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_payed' => true,
            ];
        });
    }
}
