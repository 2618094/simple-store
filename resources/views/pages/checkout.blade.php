@extends('layouts.app')
@section('title', 'Products')
@section('content')
    <h1>Checkout</h1>
    <div class="row">
        <div class="col-md-6">
            <h2>Product: {{ $product->name }}</h2>
            <p>Brand: {{ $product->brand->name }}</p>
            <p>Price: {{ $product->price }}</p>
            <form method="post" action="{{ route('orders.store') }}">
                @csrf
                <h2>Shipping</h2>
                @foreach($shippings as $shipping)
                    <div class="form-check">
                        <input class="form-check-input @error('shipping_id') is-invalid @enderror" type="radio" name="shipping_id" id="shipping_{{ $shipping->id }}"
                               value="{{ $shipping->id }}" {{ old('shipping') == $shipping->id ?'checked' : null }}>
                        <label class="form-check-label" for="shipping_{{ $shipping->id }}">
                            {{ $shipping->name }} - {{ $shipping->price }} EUR
                        </label>
                        @error('shipping_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                @endforeach
                <h2>Customer details</h2>
                @include('blocks.inputs.text', ['field' => 'client_name', 'label' => 'Name'])
                @include('blocks.inputs.text', ['field' => 'client_address', 'label' => 'Address'])
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
