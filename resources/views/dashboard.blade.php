<x-app-layout>
    <!-- Bootstrap Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Prodify Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}">Manage Products</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-danger nav-link text-white" style="border: none;">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Welcome Section -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="mb-3">Welcome, {{ Auth::user()->name }}!</h1>
                <p class="lead">Manage your products and more from this dashboard.</p>
            </div>
        </div>
    </div>

    <!-- Dashboard Cards -->
    <div class="container mt-5">
        <div class="row">
            <!-- Manage Products Card -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Manage Products</h5>
                        <p class="card-text">View, add, edit, or delete products in your inventory.</p>
                        <a href="{{ route('products.index') }}" class="btn btn-primary">Go to Products</a>
                    </div>
                </div>
            </div>

            <!-- Profile Card -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Your Profile</h5>
                        <p class="card-text">Update your account information and preferences.</p>
                        <a href="#" class="btn btn-secondary">Edit Profile</a>
                    </div>
                </div>
            </div>

            <!-- Support Card -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Need Help?</h5>
                        <p class="card-text">Contact our support team for assistance.</p>
                        <a href="#" class="btn btn-success">Get Support</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
