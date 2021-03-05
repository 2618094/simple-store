@extends('layouts.app')
@section('title', 'Products')
@section('content')
<h1>Our products</h1>
<div class="row">
    <div class="col-sm-6">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Brand</th>
                <th scope="col">Product</th>
                <th scope="col">Price</th>
                <th scope="col">Buy</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->brand->name }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>Buy button placeholder</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {!! $products->links() !!}
        </div>
    </div>
</div>
@endsection
