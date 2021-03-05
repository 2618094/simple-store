<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Brand::factory()->count(5)->create() as $brand){
            Product::factory()->count(5)->for($brand)->create();
        }
    }
}
