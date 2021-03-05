@extends('layouts.app')
@section('title', 'Order #'. $order->id)
@section('content')
    <div class="row">
        <div class="col-md-3">
            <h1>Order #{{ $order->id }}</h1>
            <p>Total: {{ $order->total_value }}</p>
            <p>Product: {{ $order->total_product_value }}</p>
            <p>Shipping: {{ $order->total_shipping_value }}</p>
            <p><span class="badge {{ $order->is_payed ? 'bg-success' : 'bg-danger' }}">{{ $order->is_payed ? 'Payed' : 'Unpaid' }}</span></p>
            @if(! $order->is_payed)
                <a class="btn btn-success" href="{{ route('payments.create', $order->id) }}" role="button">Pay now</a>
            @endif
        </div>
    </div>
@endsection
