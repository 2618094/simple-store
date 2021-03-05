@extends('layouts.app')
@section('title', 'Payment for order')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <h1>Making payment for Order # {{ $order->id }}</h1>
            <h2>Total value: {{ $order->total_value }} EUR</h2>
            <form method="post" action="{{ route('payments.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="credit_card" class="form-label">Credit card</label>
                    <input type="text" class="form-control" name="credit_card" id="credit_card" value="{{ old('credit_card') }}">
                </div>
                <input type="hidden" name="order_id" value="{{ $order->id }}">
                <button type="submit" class="btn btn-success">Make payment</button>
            </form>
        </div>
    </div>
@endsection
