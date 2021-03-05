<?php

namespace App\Events\Payment;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PaymentComplete
{
    use Dispatchable, SerializesModels;

    private int $order_id;

    /**
     * Create a new event instance.
     *
     * @param int $order_id
     */
    public function __construct(int $order_id)
    {
        $this->order_id = $order_id;
    }

    /**
     * @return int
     */
    public function getOrderId(): int
    {
        return $this->order_id;
    }
}
