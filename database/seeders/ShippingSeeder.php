<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Shipping;
use Illuminate\Database\Seeder;

class ShippingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shippings = [
            [
                'name' => 'Free standard',
                'price' => 0
            ],
            [
                'name' => 'Express',
                'price' => 10
            ]
        ];
        foreach ($shippings as $shipping){
            Shipping::factory()->create($shipping);
        }
    }
}
