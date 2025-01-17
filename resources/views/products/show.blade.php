@extends('layout')

@section('content')
<div class="container mt-4">
    <h1>Product Details</h1>
    <div class="card">
        <div class="card-body">
            <div class="mb-3 text-center">
                <h3>Product Images</h3>
                @if($product->getMedia('images')->count() > 0)
                    <div class="d-flex flex-wrap justify-content-center">
                        @foreach($product->getMedia('images') as $image)
                            <img src="{{ $image->getUrl() }}" alt="{{ $product->name }}" class="img-thumbnail m-2" style="width: 150px; height: 150px;">
                        @endforeach
                    </div>
                @else
                    <p>No images available</p>
                @endif
            </div>


            <!-- Product Details -->
            <p><strong>Name:</strong> {{ $product->name }}</p>
            <p><strong>Description:</strong> {{ $product->description }}</p>
            <p><strong>Price:</strong> ${{ $product->price }}</p>
        </div>
    </div>
    <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection
