@extends('layouts.app')

@section('content')
<div x-data="{ showModal: false }" class="space-y-6">
    <!-- Header Section -->
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
            All Annonces
        </h1>
        
        <!-- Add Annonce Button -->
        <button @click="showModal = true" 
                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add Annonce
        </button>
    </div>

    <!-- Annonces Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($annonces as $annonce)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200 overflow-hidden border border-gray-200 dark:border-gray-700">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-3">
                        <a href="{{ route('annonces.show', $annonce->id) }}" 
                           class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-150">
                            {{ $annonce->title }}
                        </a>
                    </h2>
                    
                    <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-3">
                        {{ $annonce->description }}
                    </p>

                    <div class="flex items-center justify-between mt-4">
                        <span class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                            {{ number_format($annonce->price, 2) }} €
                        </span>
                        
                        <a href="{{ route('annonces.show', $annonce->id) }}" 
                           class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition-colors duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="text-center bg-gray-50 dark:bg-gray-800/50 rounded-lg px-6 py-10">
                    <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">No annonces</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Get started by creating a new annonce.</p>
                    <div class="mt-6">
                        <button @click="showModal = true" 
                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Add Annonce
                        </button>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Create Annonce Modal -->
    <div x-show="showModal" 
         class="fixed inset-0 overflow-y-auto z-50"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        <!-- Modal Backdrop -->
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
    @click="showModal = false"></div>

        <!-- Modal Content -->
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div 
                 class="relative transform overflow-hidden rounded-lg bg-white dark:bg-gray-800 px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                
                <div class="absolute right-0 top-0 pr-4 pt-4">
                    <button @click="showModal = false" class="rounded-md bg-white dark:bg-gray-800 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
                        <h3 class="text-lg font-semibold leading-6 text-gray-900 dark:text-gray-100">
                            Create New Annonce
                        </h3>
                        
                        <form action="{{ route('annonces.store') }}" method="POST" class="mt-6 space-y-4">
                            @csrf
                            
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Title
                                </label>
                                <input type="text" 
                                       name="title" 
                                       id="title" 
                                       class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                       required>
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Description
                                </label>
                                <textarea name="description" 
                                          id="description" 
                                          rows="3" 
                                          class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                          required></textarea>
                            </div>

                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Price (€)
                                </label>
                                <input type="number" 
                                       name="price" 
                                       id="price" 
                                       step="0.01" 
                                       min="0" 
                                       class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                       required>
                            </div>

                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Category
                                </label>
                                <select name="category_id" 
                                        id="category_id" 
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        required>
                                    <option value="">Select a category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mt-5 sm:mt-6 sm:flex sm:flex-row-reverse">
                                <button type="submit" 
                                        class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:ml-3 sm:w-auto">
                                    Create Annonce
                                </button>
                                <button type="button" 
                                        @click="showModal = false" 
                                        class="mt-3 inline-flex w-full justify-center rounded-md bg-white dark:bg-gray-700 px-3 py-2 text-sm font-semibold text-gray-900 dark:text-gray-100 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 sm:mt-0 sm:w-auto">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    @if($annonces->count() > 0 && $annonces instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="mt-6">
            {{ $annonces->links() }}
        </div>
    @endif
</div>
@endsection