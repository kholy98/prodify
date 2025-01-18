@extends('layout')

@section('content')
<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
<link
    href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
    rel="stylesheet"
/>
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="text-center mb-4">Create New Product</h1>

            <!-- Enhanced Form Card -->
            <div class="card shadow-lg">
                <div class="card-body p-4">
                    <!-- Form Start -->
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Product Name -->
                        <div class="mb-4">
                            <label for="name" class="form-label">Product Name</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Enter product name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="Enter product description">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div class="mb-4">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" step="0.01" value="{{ old('price') }}" placeholder="Enter product price">
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Product Images -->
                        <div class="mb-4">
                            <label for="images" class="form-label">Product Images</label>
                            <input type="file" name="image" id="images" class="filepond @error('image') is-invalid @enderror" multiple credits="false" />
                            <small class="form-text text-muted">You can upload multiple images for this product.</small>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-lg w-100">Save Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>

<script>
    // Register the plugin
    FilePond.registerPlugin(FilePondPluginImagePreview);

    // Get a reference to the file input element
    const inputElement = document.querySelector('input[type="file"]');

    // Create a FilePond instance
    const pond = FilePond.create(inputElement);

    FilePond.setOptions({
        server: {
            process:  "{{ route('products.upload') }}",
            method: 'POST',
            revert: {
                url: "{{ route('products.delete-image') }}",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            },
            headers: {
                'x-CSRF-TOKEN': '{{ csrf_token() }}',
            },
        },
        imagePreviewHeight: 100,
        stylePanelLayout: 'compact',
        styleLoadIndicatorPosition: 'center bottom',
        styleButtonRemoveItemPosition: 'left bottom',
        
    });
</script>

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

    .filepond--item {
        width: 170px;
        margin-right: 15px;
    }

    .filepond--panel-root {
        border-radius: 15px;
    }
</style>

@endsection
