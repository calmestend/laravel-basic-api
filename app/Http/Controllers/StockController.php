<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $stocks = Stock::all();

        return response()->json([
            'stocks' => $stocks,
            'message' => 'Stocks returned successfully',
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
        ]);

        $stock = Stock::created([
            'product_id' => $request->product_id,
        ]);

        return response()->json([
            'stock' => $stock,
            'message' => 'Stocks created successfully',
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stock $stock): JsonResponse
    {
        $request->validate([
            'product_id' => ['sometimes', 'integer', 'exists:products,id'],
        ]);

        $stock->update($request->only([
            'product_id'
        ]));

        return response()->json([
            'stock' => $stock,
            'message' => 'Stock updated successfully',
        ], 200);
    }
}
