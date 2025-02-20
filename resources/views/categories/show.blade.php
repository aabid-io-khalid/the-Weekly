@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
            {{ $category->name }}
        </h1>
    </div>

    <!-- Category Description -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border border-gray-200 dark:border-gray-700">
        <p class="text-gray-600 dark:text-gray-300">
            {{ $category->description ?? 'No description available' }}
        </p>
    </div>

    <!-- Related Annonces -->
    <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Related Annonces</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($category->annonces as $annonce)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200 overflow-hidden border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">
                    <a href="{{ route('annonces.show', $annonce->id) }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-150">
                        {{ $annonce->title }}
                    </a>
                </h3>
                <p class="text-gray-600 dark:text-gray-300 text-sm line-clamp-3">
                    {{ $annonce->description }}
                </p>
            </div>
        @empty
            <div class="col-span-full text-center bg-gray-50 dark:bg-gray-800/50 rounded-lg px-6 py-10">
                <p class="text-sm text-gray-500 dark:text-gray-400">No annonces available.</p>
            </div>
        @endforelse
    </div>

    <a href="{{ route('categories.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
        Back to Categories
    </a>
</div>
@endsection
