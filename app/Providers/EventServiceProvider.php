<?php

namespace App\Providers;

use App\Events\Order\OrderPayed;
use App\Events\Payment\PaymentComplete;
use App\Listeners\Order\NotifyAdminAboutPayedOrder;
use App\Listeners\Order\PayOrderByCompletedPayment;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        PaymentComplete::class => [
            PayOrderByCompletedPayment::class,
        ],
        OrderPayed::class => [
            NotifyAdminAboutPayedOrder::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
