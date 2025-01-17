@extends('layout')

@section('content')
<div class="container mt-4">
    <h1>Product Details</h1>
    <p><strong>Name:</strong> {{ $product->name }}</p>
    <p><strong>Description:</strong> {{ $product->description }}</p>
    <p><strong>Price:</strong> ${{ $product->price }}</p>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection
