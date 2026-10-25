<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    // 1. Get all categories
    public function index()
    {
        return response()->json(Categories::all());
    }

    // 2. Create a new category
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Categories::create($validated);
        return response()->json($category, 201);
    }

    // 3. Get single category by ID
    public function show(string $id)
    {
        $category = Categories::findOrFail($id);
        return response()->json($category);
    }

    // 4. Update category
    public function update(Request $request, string $id)
    {
        $category = Categories::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update($validated);
        return response()->json($category);
    }

    // 5. Delete category
    public function destroy(string $id)
    {
        $category = Categories::findOrFail($id);
        $category->delete();

        return response()->json(['message' => 'Category deleted successfully']);
    }
}