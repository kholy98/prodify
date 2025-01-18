@extends('layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="text-center mb-4">Welcome Back!</h1>
            <p class="text-center text-muted">Please login to access your account.</p>

            <!-- Login Card -->
            <div class="card shadow-lg">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address -->
                        <div class="mb-4">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="mb-4 d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input type="checkbox" name="remember" id="remember_me" class="form-check-input">
                                <label for="remember_me" class="form-check-label">Remember Me</label>
                            </div>
                            <a href="{{ route('password.request') }}" class="text-decoration-none text-primary">Forgot Password?</a>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Login</button>
                        </div>
                    </form>

                    <!-- Registration Link -->
                    <div class="mt-4 text-center">
                        <p class="text-muted">
                            Don't have an account?
                            <a href="{{ route('register') }}" class="text-decoration-none fw-semibold text-primary">Create one now</a>.
                        </p>
                    </div>
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

    .btn-primary {
        border-radius: 30px;
        font-size: 1.2rem;
    }

    .form-check-input {
        border-radius: 5px;
    }

    .form-control {
        border-radius: 10px;
    }
</style>
@endsection
