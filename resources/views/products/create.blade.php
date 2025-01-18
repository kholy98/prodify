@extends('layout')

@section('content')
<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
<link
    href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
    rel="stylesheet"
/>
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

<div class="container mt-4">
    <h1>Create New Product</h1>

    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4" > {{ old('description') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" name="price" id="price" class="form-control" step="0.01" value="{{ old('price') }}">
        </div>

        <div class="mb-3">
            <label for="images" class="form-label">Product Images</label>
            <input type="file" name="image" id="images" class="filepond" multiple credits="false" />
        </div>

        <button type="submit" class="btn btn-success">Save</button>
    </form>
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
    });
</script>
@endsection
