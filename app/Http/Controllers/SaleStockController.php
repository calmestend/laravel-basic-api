<?php

namespace App\Http\Controllers;

use App\Models\SaleStock;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SaleStockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $saleStocks = SaleStock::all();

        return response()->json([
            'sale_stocks' => $saleStocks,
            'message' => 'Sale stocks returned successfully',
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'stock_id' => ['required', 'integer', 'exists:stocks,id'],
            'sale_id' => ['required', 'integer', 'exists:sales,id'],
            'quantity'       => ['required', 'numeric', 'min:1'],
        ]);

        $saleStock = SaleStock::created([
            'stock_id' => $request->stock_id,
            'sale_id' => $request->sale_id,
            'quantity' => $request->quantity,
        ]);

        return response()->json([
            'sale_stocks' => $saleStock,
            'message' => 'Sale Stock created successfully',
        ], 201);
    }
}
