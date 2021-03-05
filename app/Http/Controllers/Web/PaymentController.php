<?php

namespace App\Http\Controllers\Web;

use App\Events\Payment\PaymentComplete;
use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\CreatePaymentRequest;
use App\Models\Order;

class PaymentController extends Controller
{
    public function create(Order $order)
    {
        //TODO here we need to make payment token with order data and pass it as param, not getting order directly - but for this project it's ok
        return view('pages.payments.create', compact('order'));
    }

    public function store(CreatePaymentRequest $request)
    {
        //TODO refactor to dedicated service (with payment tokens, data signature etc.)
        $order_id = (int) $request->input('order_id');
        PaymentComplete::dispatch($order_id);
        return redirect()->route('orders.show', $order_id);
    }
}
