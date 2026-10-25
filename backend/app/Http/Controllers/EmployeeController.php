<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return response()->json(Employee::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'lastname' => 'required|string|max:45',
            'firstname' => 'required|string|max:45',
            'middlename' => 'nullable|string|max:45',
            'position' => 'required|string|max:45',
            'birthdate' => 'required|date',
            'age' => 'required|integer|min:0',
            'civil_status' => 'required|string|max:15',
            'gender' => 'required|string|max:10',
        ]);

        $employee = Employee::create($validated);
        return response()->json($employee, 201);
    }

    public function show(string $id)
    {
        $employee = Employee::findOrFail($id);
        return response()->json($employee);
    }

    public function update(Request $request, string $id)
    {
        $employee = Employee::findOrFail($id);

        $validated = $request->validate([
            'lastname' => 'required|string|max:45',
            'firstname' => 'required|string|max:45',
            'middlename' => 'nullable|string|max:45',
            'position' => 'required|string|max:45',
            'birthdate' => 'required|date',
            'age' => 'required|integer|min:0',
            'civil_status' => 'required|string|max:15',
            'gender' => 'required|string|max:10',
        ]);

        $employee->update($validated);
        return response()->json($employee);
    }

    public function destroy(string $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return response()->json(['message' => 'Employee deleted successfully']);
    }
}
