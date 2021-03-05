<?php


namespace App\Services;


use App\Events\Order\OrderCreated;
use App\Models\Order;

class OrderService
{

    public function create(\App\DataTransferObjects\CreateOrderData $data): Order
    {
        $order = new Order($data->toArray());
        $order->total_product_value = $data->product->price;
        $order->total_shipping_value = $data->shipping->price;
        $order->save();
        OrderCreated::dispatch($order);
        return $order;
    }
}
