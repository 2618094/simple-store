@extends('layouts.app')
@section('title', 'Products')
@section('content')
    <h1>Checkout</h1>
    <div class="row">
        <div class="col-md-6">
            <p class="lead">Product: {{ $product->name }}</p>
            <p>Brand: {{ $product->brand->name }}</p>
            <p>Price: {{ $product->price }}</p>
            <form method="post" action="{{ route('orders.store') }}">
                @csrf
                <h2>Shipping</h2>
                @foreach($shippings as $shipping)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="shipping_id" id="shipping_{{ $shipping->id }}"
                               value="{{ $shipping->id }}" {{ old('shipping') == $shipping->id ?'checked' : null }}>
                        <label class="form-check-label" for="shipping_{{ $shipping->id }}">
                            {{ $shipping->name }} - {{ $shipping->price }} EUR
                        </label>
                    </div>
                @endforeach
                <h2>Customer details</h2>
                <div class="mb-3">
                    <label for="client_name" class="form-label">Client name</label>
                    <input type="text" class="form-control" name="client_name" id="client_name" value="{{ old('client_name') }}">
                </div>
                <div class="mb-3">
                    <label for="client_address" class="form-label">Client address</label>
                    <input type="text" class="form-control" name="client_address" id="client_address" value="{{ old('client_address') }}">
                </div>
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
