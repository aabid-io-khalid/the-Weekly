<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Add custom fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="font-[Inter] antialiased bg-gray-50 dark:bg-gray-900">
    <div class="min-h-screen flex flex-col">
        <!-- Navbar -->
        <nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ route('dashboard') }}" class="transition-transform hover:scale-105">
                                <x-application-logo class="block h-10 w-auto fill-current text-gray-800 dark:text-gray-200" />
                            </a>
                        </div>

                        <!-- Desktop Navigation Links -->
                        <div class="hidden sm:ml-10 sm:flex sm:space-x-8">
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                                class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 transition duration-150 ease-in-out">
                                {{ __('Dashboard') }}
                            </x-nav-link>
                            
                            <div class="flex space-x-6">
                                <a href="{{ route('annonces.index') }}" 
                                   class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-700 dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-400 transition">
                                    Annonces
                                </a>
                                <a href="{{ route('categories.index') }}" 
                                   class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-700 dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-400 transition">
                                    Categories
                                </a>
                            </div>
                        </div>
                    </div>

                    @auth
                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-500 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                                    <div>{{ Auth::user()->name }}</div>
                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')" class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                    @endauth

                    <!-- Mobile menu button -->
                    <div class="flex items-center sm:hidden">
                        <button @click="open = ! open" 
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500 transition">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu -->
            <div :class="{'block': open, 'hidden': ! open}" class="sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                        class="block pl-3 pr-4 py-2 text-base font-medium transition">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('annonces.index')" :active="request()->routeIs('annonces.index')"
                        class="block pl-3 pr-4 py-2 text-base font-medium transition">
                        Annonces
                    </x-responsive-nav-link>
                    {{-- <x-responsive-nav-link :href="route('annonces.create')" :active="request()->routeIs('annonces.create')"
                        class="block pl-3 pr-4 py-2 text-base font-medium transition">
                        Create Annonce
                    </x-responsive-nav-link> --}}
                    <x-responsive-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.index')"
                        class="block pl-3 pr-4 py-2 text-base font-medium transition">
                        Categories
                    </x-responsive-nav-link>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="flex-1 py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                <p class="text-center text-sm text-gray-500 dark:text-gray-400">
                    © {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
                </p>
            </div>
        </footer>
    </div>
</body>
</html>