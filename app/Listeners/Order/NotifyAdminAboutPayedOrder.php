<?php

namespace App\Listeners\Order;

use App\Events\Order\OrderPayed;
use App\Models\User;
use App\Notifications\Order\OrderPayedNotification;
use Illuminate\Support\Facades\Notification;

class NotifyAdminAboutPayedOrder
{

    /**
     * Handle the event.
     *
     * @param  OrderPayed  $event
     * @return void
     */
    public function handle(OrderPayed $event)
    {
        $users = User::admins()->get();
        $notification = new OrderPayedNotification($event->getOrder());
        Notification::send($users, $notification);
    }
}
