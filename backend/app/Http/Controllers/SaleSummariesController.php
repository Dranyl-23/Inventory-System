<?php

namespace App\Http\Controllers;

use App\Models\Sale_Summaries;
use Illuminate\Http\Request;

class SaleSummariesController extends Controller
{
    public function index()
    {
        return response()->json(Sale_Summaries::with(['sale', 'customer', 'employee'])->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sale_id' => 'required|string|exists:sales,id',
            'customer_id' => 'required|string|exists:customers,id',
            'employee_id' => 'required|string|exists:employees,id',
            'amount' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
        ]);

        $saleSummary = Sale_Summaries::create($validated);
        return response()->json($saleSummary, 201);
    }

    public function show(string $id)
    {
        $saleSummary = Sale_Summaries::with(['sale', 'customer', 'employee'])->findOrFail($id);
        return response()->json($saleSummary);
    }

    public function update(Request $request, string $id)
    {
        $saleSummary = Sale_Summaries::findOrFail($id);

        $validated = $request->validate([
            'sale_id' => 'required|string|exists:sales,id',
            'customer_id' => 'required|string|exists:customers,id',
            'employee_id' => 'required|string|exists:employees,id',
            'amount' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
        ]);

        $saleSummary->update($validated);
        return response()->json($saleSummary);
    }

    public function destroy(string $id)
    {
        $saleSummary = Sale_Summaries::findOrFail($id);
        $saleSummary->delete();

        return response()->json(['message' => 'Sale summary deleted successfully']);
    }
}
