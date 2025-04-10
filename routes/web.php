<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SaleStockController;
use App\Http\Controllers\ShoppingCartProductController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;


// CategoryController
Route::get('categories', [CategoryController::class, 'index']);

// ProductController
Route::get('products', [ProductController::class, 'index']);
Route::post('products', [ProductController::class, 'store']);
Route::patch('products', [ProductController::class, 'update']);
Route::delete('products', [ProductController::class, 'switchActiveStatus']);

// StockController
Route::get('stocks', [StockController::class, 'index']);
Route::post('stocks', [StockController::class, 'store']);
Route::patch('stocks', [StockController::class, 'update']);

// SaleController
Route::get('sale', [SaleController::class, 'index']);
Route::post('sale', [SaleController::class, 'store']);

// SaleStockController
Route::get('sale_stock', [SaleStockController::class, 'index']);
Route::post('sale_stock', [SaleStockController::class, 'store']);

// ShoppingCartProductController
Route::get('shopping_cart_product', [ShoppingCartProductController::class, 'index']);
Route::post('shopping_cart_product', [ShoppingCartProductController::class, 'store']);
Route::patch('shopping_cart_product', [ShoppingCartProductController::class, 'update']);
Route::delete('shopping_cart_product', [ShoppingCartProductController::class, 'destroy']);

require __DIR__ . '/auth.php';
