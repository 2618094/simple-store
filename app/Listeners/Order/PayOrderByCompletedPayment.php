<?php

namespace App\Listeners\Order;

use App\Events\Payment\PaymentComplete;
use App\Models\Order;
use App\Services\OrderService;

class PayOrderByCompletedPayment
{
    /**
     * @var OrderService
     */
    private OrderService $service;

    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle the event.
     *
     * @param  PaymentComplete  $event
     * @return void
     */
    public function handle(PaymentComplete $event)
    {
        $order = Order::find($event->getOrderId());
        $this->service->pay($order);
    }
}
