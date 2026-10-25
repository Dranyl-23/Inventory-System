<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SaleSummariesController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StocksController;
use App\Http\Controllers\SupplierController;

Route::get('/user', function () {
    return response()->json(\App\Models\User::all());
});

Route::post('/user', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6',
    ]);

    return response()->json(\App\Models\User::create($validated), 201);
});

Route::apiResource('categories', CategoriesController::class);
Route::apiResource('customers', CustomerController::class);
Route::apiResource('employees', EmployeeController::class);
Route::apiResource('items', ItemController::class);
Route::apiResource('sales_summaries', SaleSummariesController::class);
Route::apiResource('sales', SaleController::class);
Route::apiResource('stocks', StocksController::class);
Route::apiResource('suppliers', SupplierController::class);
