<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Product::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'productname' => 'required|string|max:255',
            'currentinventory' => 'required|string|max:255',
            'averagesales' => 'required|string|max:255',
            'replenishdays' => 'required|string|max:255',
        ]);

        $product = Product::create($validated);

        return response()->json($product, 201);
    }

    public function show(Product $product)
    {
        return $product;
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'productname' => 'required|string|max:255',
            'currentinventory' => 'required|string|max:255',
            'averagesales' => 'required|string|max:255',
            'replenishdays' => 'required|string|max:255',
        ]);

        $product->update($validated);

        return response()->json($product, 200);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(null, 204);
    }
}
