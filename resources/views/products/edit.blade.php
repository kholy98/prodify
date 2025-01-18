@extends('layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="text-center mb-4">Edit Product</h1>

            <!-- Enhanced Form Card -->
            <div class="card shadow-lg">
                <div class="card-body p-4">
                    <form action="{{ route('products.update', $product) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Product Name -->
                        <div class="mb-4">
                            <label for="name" class="form-label">Product Name</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $product->name) }}" placeholder="Enter product name" >
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="Enter product description" >{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div class="mb-4">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" step="0.01" value="{{ old('price', $product->price) }}" placeholder="Enter product price" >
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-lg w-100">Update Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border: none;
        border-radius: 15px;
    }

    .card h1 {
        font-size: 2rem;
        color: #343a40;
    }

    .form-control {
        border-radius: 10px;
    }

    .btn-success {
        border-radius: 30px;
        padding: 10px 20px;
        font-size: 1.2rem;
    }
</style>
@endsection
