<x-guest-layout>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <div class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900">
        <div class="w-full max-w-md p-8 bg-white dark:bg-gray-800 shadow-lg rounded-lg">
            <h2 class="text-2xl font-semibold text-center text-gray-800 dark:text-gray-200 mb-6">Login to Your Account</h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" class="text-gray-600 dark:text-gray-300" />
                    <x-text-input id="email" class="block mt-1 w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" class="text-gray-600 dark:text-gray-300" />
                    <x-text-input id="password" class="block mt-1 w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between mb-4">
                    <label for="remember_me" class="inline-flex items-center text-gray-600 dark:text-gray-300">
                        <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                        <span class="ml-2 text-sm">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <!-- Login Button -->
                <div class="mt-6">
                    <x-primary-button class="w-full text-center px-4 py-2 bg-indigo-600 text-white font-bold rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>

                <!-- Register Link -->
                <div class="mt-4 text-center">
                    <p class="text-sm text-gray-600 dark:text-gray-300">Don't have an account? 
                        <a href="{{ route('register') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">Register</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
