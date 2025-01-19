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
                    <th>Media</th>
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
                    <td>
                        <div class="d-flex">
                            @php
                                $media = $product->getMedia('images');
                                $firstTwo = $media->take(2); // Get the first 2 images
                                $remainingCount = $media->count() - $firstTwo->count();
                            @endphp
                            @foreach($firstTwo as $image)
                                <img src="{{ $image->getUrl() }}" alt="{{ $product->name }}" class="img-thumbnail me-1" width="50" height="50">
                            @endforeach
                            @if($remainingCount > 0)
                                <!-- Button to trigger modal -->
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#productImagesModal{{ $product->id }}">
                                    +{{ $remainingCount }}
                                </button>
                            @endif
                        </div>

                        <!-- Modal for remaining images -->
                        <div class="modal fade" id="productImagesModal{{ $product->id }}" tabindex="-1" aria-labelledby="productImagesModalLabel{{ $product->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="productImagesModalLabel{{ $product->id }}">Additional Images for {{ $product->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="d-flex flex-wrap">
                                            @foreach($media->skip(2) as $image)
                                                <img src="{{ $image->getUrl() }}" alt="{{ $product->name }}" class="img-thumbnail me-2 mb-2" style="width: 100px; height: 100px;">
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
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
          
          <div class="d-flex justify-content-center mt-4">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>


@endsection
