<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    private OrderService $service;

    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    public function store(CreateOrderRequest $request)
    {
        $order = $this->service->create($request->data());
        return redirect()->route('orders.show', $order->id);
    }

    public function show(Order $order)
    {
        return view('pages.orders.show', compact('order'));
    }
}
