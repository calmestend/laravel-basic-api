<?php

namespace App\Http\Controllers;

use App\Models\ShoppingCartProduct;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ShoppingCartProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $shoppingCartProducts = ShoppingCartProduct::all();

        return response()->json([
            'shopping_cart_products' => $shoppingCartProducts,
            'message' => 'Shopping cart products returned successfully',
        ], 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'stock_id' => ['required', 'integer', 'exists:stocks,id'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'quantity' => ['required', 'numeric', 'min:1'],
        ]);

        $shoppingCartProduct = ShoppingCartProduct::created([
            'stock_id' => $request->stock_id,
            'user_id' => $request->user_id,
            'quantity' => $request->quantity,
        ]);

        return response()->json([
            'shopping_cart_product' => $shoppingCartProduct,
            'message' => 'Shopping cart products created successfully',
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ShoppingCartProduct $shoppingCartProduct): JsonResponse
    {
        $request->validate([
            'stock_id' => ['sometimes', 'integer', 'exists:stocks,id'],
            'user_id' => ['sometimes', 'integer', 'exists:users,id'],
            'quantity' => ['sometimes', 'numeric', 'min:1'],
        ]);

        $shoppingCartProduct->update($request->only([
            'stock_id',
            'user_id',
            'quantity',
        ]));

        return response()->json([
            'shopping_cart_product' => $shoppingCartProduct,
            'message' => 'Shopping cart products updated successfully',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShoppingCartProduct $shoppingCartProduct): JsonResponse
    {
        $shoppingCartProduct->delete();

        return response()->json([
            'message' => 'Shopping cart product deleted successfully',
        ], 200);
    }
}
