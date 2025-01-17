<x-guest-layout>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
        <!-- Logo Section -->
        <div class="mb-8">
            <img src="{{ asset('images/ninja.jpeg') }}" alt="Logo" class="w-24 h-24 mx-auto">
        </div>

        <!-- Form Container -->
        <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
            <h1 class="text-2xl font-bold text-center text-gray-700">Welcome Back!</h1>
            <p class="mt-2 text-sm text-center text-gray-500">Please login to access your account.</p>

            <form method="POST" action="{{ route('login') }}" class="mt-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" type="email" name="email" required autofocus
                        class="block w-full px-4 py-2 mt-1 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300">
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" type="password" name="password" required
                        class="block w-full px-4 py-2 mt-1 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300">
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" name="remember"
                            class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <span class="ml-2 text-sm text-gray-600">Remember me</span>
                    </label>

                    <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:underline">
                        Forgot your password?
                    </a>
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit"
                    class="w-full px-4 py-2 text-white bg-indigo-600 rounded-md hover:bg-green-700 focus:ring-4 focus:ring-indigo-200">
                        Login
                    </button>
                </div>
            </form>

            <!-- Registration Link -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-indigo-600 hover:underline font-semibold">
                        Create one now
                    </a>.
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
