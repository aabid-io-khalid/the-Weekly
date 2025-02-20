@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Créer une Nouvelle Annonce</h1>

    <form action="{{ route('annonces.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Titre</label>
            <input type="text" id="title" name="title" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea id="description" name="description" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" required></textarea>
        </div>

        <div class="mb-4">
            <label for="category_id" class="block text-sm font-medium text-gray-700">Catégorie</label>
            <select id="category_id" name="category_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="price" class="block text-sm font-medium text-gray-700">Prix (€)</label>
            <input type="text" id="price" name="price" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
        </div>

        <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
            <input type="file" id="image" name="image" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
        </div>

        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Créer Annonce</button>
        </div>
    </form>
</div>
@endsection
