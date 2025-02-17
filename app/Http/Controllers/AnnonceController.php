<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Category;
use Illuminate\Http\Request;

class AnnonceController extends Controller
{
    public function index()
    {
        $annonces = Annonce::with('category')->paginate(9);
        $categories = Category::all(); 
        return view('annonces.index', compact('annonces', 'categories'));
    }

    public function show(Annonce $annonce)
{
    $annonce->load(['comments.user', 'category']);
    
    return view('annonces.show', compact('annonce'));
}

    public function create()
    {
        $categories = Category::all();
        return view('annonces.create', compact('categories'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price' => 'nullable|numeric',
            'image' => 'nullable|image',
    ]);

    Annonce::create($validated);

    return redirect()->route('annonces.index')
        ->with('success', 'Annonce created successfully.');
}

    public function edit(Annonce $annonce)
    {
        $categories = Category::all();
        return view('annonces.edit', compact('annonce', 'categories'));
    }

    public function update(Request $request, Annonce $annonce)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price' => 'nullable|numeric',
            'image' => 'nullable|image',
        ]);

        // Handle image upload (if any)
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $validated['image'] = $imagePath; // Update the image path
        }

        // Update the annonce
        $annonce->update($validated);

        return redirect()->route('annonces.index')->with('success', 'Annonce updated successfully');
    }

    public function destroy(Annonce $annonce)
    {
        $annonce->delete();
        return redirect()->route('annonces.index')->with('success', 'Annonce deleted successfully');
    }
}
