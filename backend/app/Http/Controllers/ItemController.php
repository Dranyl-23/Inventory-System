<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        return response()->json(Item::with('category')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|string|exists:categories,id',
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $item = Item::create($validated);
        return response()->json($item, 201);
    }

    public function create(Request $request)
    {
        return $this->store($request);
    }

    public function show(string $id)
    {
        $item = Item::with('category')->findOrFail($id);
        return response()->json($item);
    }

    public function update(Request $request, string $id)
    {
        $item = Item::findOrFail($id);

        $validated = $request->validate([
            'category_id' => 'required|string|exists:categories,id',
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $item->update($validated);
        return response()->json($item);
    }

    public function destroy(string $id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return response()->json(['message' => 'Item deleted successfully']);
    }
}