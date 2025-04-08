<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $sales = Sale::all();

        return response()->json([
            'sales' => $sales,
            'message' => 'Sales returned successfully',
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'iva'       => ['required', 'numeric', 'min:1'],
            'total'       => ['required', 'numeric', 'min:1'],
        ]);

        $sale = Sale::created([
            'user_id' => $request->user_id,
            'iva' => $request->iva,
            'total' => $request->total,
        ]);

        return response()->json([
            'sale' => $sale,
            'message' => 'Sale created successfully',
        ], 201);
    }
}
