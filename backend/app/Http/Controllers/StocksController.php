<?php

namespace App\Http\Controllers;

use App\Models\Stocks;
use Illuminate\Http\Request;

class StocksController extends Controller
{
    public function index()
    {
        return response()->json(Stocks::with(['supplier', 'item'])->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|string|exists:suppliers,id',
            'item_id' => 'required|string|exists:items,id',
            'quantity' => 'required|integer|min:0',
        ]);

        $stock = Stocks::create($validated);
        return response()->json($stock, 201);
    }

    public function show(string $id)
    {
        $stock = Stocks::with(['supplier', 'item'])->findOrFail($id);
        return response()->json($stock);
    }

    public function update(Request $request, string $id)
    {
        $stock = Stocks::findOrFail($id);

        $validated = $request->validate([
            'supplier_id' => 'required|string|exists:suppliers,id',
            'item_id' => 'required|string|exists:items,id',
            'quantity' => 'required|integer|min:0',
        ]);

        $stock->update($validated);
        return response()->json($stock);
    }

    public function destroy(string $id)
    {
        $stock = Stocks::findOrFail($id);
        $stock->delete();

        return response()->json(['message' => 'Stock deleted successfully']);
    }
}
