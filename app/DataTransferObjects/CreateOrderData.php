<?php


namespace App\DataTransferObjects;


use App\Http\Requests\Order\CreateOrderRequest;
use App\Models\Product;
use App\Models\Shipping;
use Spatie\DataTransferObject\DataTransferObject;

class CreateOrderData extends DataTransferObject
{
    public Shipping $shipping;
    public Product $product;
    public string $client_name;
    public string $client_address;

    public static function fromRequest(CreateOrderRequest $request): self
    {
        return new self([
            'shipping' => Shipping::query()->find($request->input('shipping_id')),
            'product' => Product::query()->find($request->input('product_id')),
            'client_name' => $request->input('client_name'),
            'client_address' => $request->input('client_address'),
        ]);
    }
}
