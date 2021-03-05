<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use App\Notifications\Order\OrderPayedNotification;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class PaymentControllerTest extends TestCase
{
    use DatabaseMigrations;
    use WithFaker;

    public function testPayPayment()
    {
        Notification::fake();
        $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $order = Order::factory()->create();
        $params = [
            'credit_card' => $this->faker->creditCardNumber,
            'order_id' => $order->id,
        ];

        $this->post(route('payments.store'), $params)
            ->assertRedirect();

        Notification::assertSentTo($admin, OrderPayedNotification::class);

    }
}
