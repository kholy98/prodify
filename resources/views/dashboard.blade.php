@extends('layout')

@section('content')

<!-- Welcome Section -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1 class="mb-3">Welcome, {{ Auth::user()->name }}!</h1>
            <p class="lead">Manage your products and more from this dashboard.</p>
        </div>
    </div>

    <!-- Dashboard Links Section -->
    <div class="row mt-5">
        <div class="col-md-4 offset-md-4">
            <a href="{{ route('products.index') }}" class="text-decoration-none">
                <div class="card text-center shadow-sm hover-zoom">
                    <div class="card-body">
                        <i class="bi bi-box-seam display-3 text-primary"></i>
                        <h5 class="card-title mt-3">Manage Products</h5>
                        <p class="card-text">View, edit, and organize your product catalog effortlessly.</p>
                        <button class="btn btn-primary btn-sm mt-2">Go to Products</button>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<!-- Add some hover effect -->
<style>
    .hover-zoom:hover {
        transform: scale(1.05);
        transition: transform 0.2s ease-in-out;
    }
</style>

@endsection
