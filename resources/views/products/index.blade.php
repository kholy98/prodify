@extends('layout')

@section('content')
    <div class="container mt-4">
        <h1>Product List</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Create New Product</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>${{ $product->price }}</td>
                    <td>
                    <div class="d-flex align-items-center">
    <a href="{{ route('products.show', $product) }}" class="btn btn-info btn-sm d-flex justify-content-center align-items-center me-2" data-bs-toggle="tooltip" title="View">
        <i class="bi bi-eye"></i>
    </a>
    <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm d-flex justify-content-center align-items-center me-2" data-bs-toggle="tooltip" title="Edit">
        <i class="bi bi-pencil"></i>
    </a>
    <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline-block" data-bs-toggle="tooltip" title="Delete">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm d-flex justify-content-center align-items-center">
            <i class="bi bi-trash"></i>
        </button>
    </form>
</div>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
