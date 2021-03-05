<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Shipping;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __invoke(Product $product)
    {
        $product->loadMissing('brand');
        $shippings = Shipping::active()->get();
        return view('pages.checkout', compact('product', 'shippings'));
    }
}
