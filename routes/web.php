<?php

use App\Models\Inventory;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('about');
});

Route::get('/warehouses', function () {
    $warehouses = Warehouse::cursorPaginate(5);
    return view('warehouses', ['warehouses' => $warehouses]);
});

Route::get('/products', function () {
    $products = Product::cursorPaginate(5);
    return view('products', ['products' => $products]);
});

Route::get('/products/{id}', function ($id) {
    $general_quantity = Inventory::where('product_id', $id)->all()->sum('quantity');
    $product = Product::where('id', $id)->firstOrFail();
    if (!$product) {
        abort(404);
    }
    return view('product', ['product' => $product], ['general_quantity' => $general_quantity]);
});
Route::get('/inventory/{id}', function ($id) {
    $warehouse_items = Inventory::where('warehouse_id', $id)->cursorPaginate(20);
    return view('inventory', ['inventory' => $warehouse_items]);
});

