@extends('layouts.app')

@section('content')
<div class="flex flex-col min-h-screen">
    <div class="container mx-auto py-8 flex-grow">
        <!-- Annonce Details Card -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $annonce->title }}</h1>

            <div class="mb-6 space-y-2">
                <p class="text-gray-600"><strong>Description:</strong> {{ $annonce->description }}</p>
                <p class="text-gray-600"><strong>Category:</strong> {{ $annonce->category->name ?? 'Uncategorized' }}</p>
                <p class="text-gray-600"><strong>Price:</strong> {{ number_format($annonce->price, 2) }} $</p>
            </div>

            <!-- Buttons Section -->
            <div class="flex justify-between items-center mt-6">
                <a href="{{ route('annonces.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded transition duration-300">
                    Back to Listings
                </a>

                <div class="flex space-x-4">
                    <a href="{{ route('annonces.edit', ['annonce' => $annonce->id]) }}" 
                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded transition duration-300">
                         Update
                     </a>

                    <form action="{{ route('annonces.destroy', $annonce) }}" method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this annonce?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded transition duration-300">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Comments Section -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Comments</h2>

            <!-- Add Comment Form -->
            <form action="{{ route('comments.store') }}" method="POST" class="mb-8">
                @csrf
                <input type="hidden" name="annonce_id" value="{{ $annonce->id }}">
                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Add a comment</label>
                    <textarea
                        name="content"
                        id="content"
                        rows="3"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Write your comment here..."
                        required
                    ></textarea>
                </div>
                <button type="submit" 
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition duration-300">
                    Post Comment
                </button>
            </form>

            <!-- Existing Comments -->
            <div class="space-y-6">
                @forelse($annonce->comments as $comment)
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center mb-2">
                                    <h3 class="font-medium text-gray-800">{{ $comment->user->name ?? 'Anonymous' }}</h3>
                                    <span class="text-gray-500 text-sm ml-2">• {{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-gray-700">{{ $comment->content }}</p>
                            </div>
                            
                            @if(auth()->check() && auth()->id() === $comment->user_id)
                                <div class="flex space-x-2">
                                    <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-500 hover:text-red-700"
                                                onclick="return confirm('Are you sure you want to delete this comment?')">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-center">No comments yet. Be the first to comment!</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection