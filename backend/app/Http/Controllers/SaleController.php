<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        return response()->json(Sale::with(['item', 'customer'])->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'nullable|string|exists:items,id',
            'user_id' => 'nullable|string|exists:users,id',
            'customer_id' => 'nullable|string|exists:customers,id',
            'amount' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'quantity' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $sale = Sale::create($validated);
        return response()->json($sale, 201);
    }

    public function show(string $id)
    {
        $sale = Sale::with(['item', 'customer'])->findOrFail($id);
        return response()->json($sale);
    }

    public function update(Request $request, string $id)
    {
        $sale = Sale::findOrFail($id);

        $validated = $request->validate([
            'item_id' => 'nullable|string|exists:items,id',
            'user_id' => 'nullable|string|exists:users,id',
            'customer_id' => 'nullable|string|exists:customers,id',
            'amount' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'quantity' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $sale->update($validated);
        return response()->json($sale);
    }

    public function destroy(string $id)
    {
        $sale = Sale::findOrFail($id);
        $sale->delete();

        return response()->json(['message' => 'Sale deleted successfully']);
    }
}
