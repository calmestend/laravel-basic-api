<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $products = Product::all();

        return response()->json([
            'products' => $products,
            'message' => 'Products returned successfully',
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'name'        => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'img'         => ['required', 'url'],
            'price'       => ['required', 'numeric', 'min:1'],
            'active'      => ['required', 'boolean'],
        ]);

        $product = Product::created([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'img' => $request->img,
            'price' => $request->price,
            'active' => $request->active,
        ]);

        return response()->json([
            'product' => $product,
            'message' => 'Products created successfully',
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => ['sometimes', 'integer', 'exists:categories,id'],
            'name'        => ['sometimes', 'string'],
            'description' => ['sometimes', 'string'],
            'img'         => ['sometimes', 'url'],
            'price'       => ['sometimes', 'numeric', 'min:1'],
            'active'      => ['sometimes', 'boolean'],
        ]);

        $product->update($request->only([
            'category_id',
            'name',
            'description',
            'img',
            'price',
            'active',
        ]));

        return response()->json([
            'product' => $product,
            'message' => 'Product updated successfully',
        ], 200);
    }

    /**
     * Update the activate status from specified resource in storage.
     */
    public function switchActiveStatus(Product $product)
    {
        $product->active = !$product->active;
        $product->save();

        return response()->json([
            'product' => $product,
            'message' => $product->active ? 'Product activated successfully' : 'Product deactivated successfully',
        ], 200);
    }
}
