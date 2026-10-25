<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return response()->json(Customer::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'lastname' => 'required|string|max:45',
            'firstname' => 'required|string|max:45',
            'middlename' => 'nullable|string|max:45',
            'birthdate' => 'required|date',
            'age' => 'required|integer|min:0',
            'gender' => 'required|string|max:10',
        ]);

        $customer = Customer::create($validated);
        return response()->json($customer, 201);
    }

    public function show(string $id)
    {
        $customer = Customer::findOrFail($id);
        return response()->json($customer);
    }

    public function update(Request $request, string $id)
    {
        $customer = Customer::findOrFail($id);

        $validated = $request->validate([
            'lastname' => 'required|string|max:45',
            'firstname' => 'required|string|max:45',
            'middlename' => 'nullable|string|max:45',
            'birthdate' => 'required|date',
            'age' => 'required|integer|min:0',
            'gender' => 'required|string|max:10',
        ]);

        $customer->update($validated);
        return response()->json($customer);
    }

    public function destroy(string $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return response()->json(['message' => 'Customer deleted successfully']);
    }
}
