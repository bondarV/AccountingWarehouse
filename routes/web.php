<?php

use App\Enums\MovementType;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WarehouseController;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Route;

Route::view('/', 'about');

Route::resource('products', ProductController::class)->only(['index', 'show']);

Route::resource('warehouses', WarehouseController::class)->only(['index', 'show']);

Route::resource('warehouses.products', InventoryController::class)->only(['index']);

Route::resource('warehouses.products.operations', OperationController::class)->only(['index', 'store', 'show', 'create'])->shallow();

//Route::post('/warehouses/{warehouse}/products/{product}/operations', function (Warehouse $warehouse, Product $productId) {
//    $inventory = Inventory::where('product_id', $productId)->where('warehouse_id', $warehouse->id)->first();
//
//    request()->validate([
//        'quantity' => ['required', 'numeric', 'min:1', 'gt:'.$inventory->quantity],
//    ]);
//
//    return redirect('/warehouses/'.$warehouse->id);
//});
