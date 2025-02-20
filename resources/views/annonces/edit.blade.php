@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Update the Annonce</h1>

    <form action="{{ route('annonces.update', $annonce) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" id="title" name="title" value="{{ old('title', $annonce->title) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea id="description" name="description" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" required>{{ old('description', $annonce->description) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
            <select id="category_id" name="category_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $annonce->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="price" class="block text-sm font-medium text-gray-700">Price ($)</label>
            <input type="text" id="price" name="price" value="{{ old('price', $annonce->price) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
        </div>

        <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
            <input type="file" id="image" name="image" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
        </div>

        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
        </div>
    </form>
</div>
@endsection
