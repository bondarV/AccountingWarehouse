<?php

use App\Enums\MovementType;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WarehouseController;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Route;

Route::view('/', 'about');

Route::resource('products', ProductController::class)->only(['index', 'show'])->only(['index', 'show']);

Route::resource('warehouses', WarehouseController::class)->only(['index', 'show'])->only(['index', 'show']);

Route::resource('warehouses.products', InventoryController::class)->shallow()->only(['index']);




Route::get('/warehouses/{warehouse}/products/{product}/transactions', function ($warehouseId, $productId) {
    $inventory = Inventory::where('warehouse_id', $warehouseId)->where('product_id', $productId)->first();

    return view('warehouses.transactions.create', ['inventory' => $inventory, 'operations' => MovementType::cases()]);
});

Route::get('/warehouses/{warehouse}/products/{product}/transactions/create', function ($warehouseId, $productId) {
    $inventory = Inventory::where('warehouse_id', $warehouseId)->where('product_id', $productId)->first();

    return view('warehouses.transactions.create', ['inventory' => $inventory, 'operations' => MovementType::cases()]);
});


Route::post('/warehouses/{warehouse}/products/{product}/transactions/create', function ($warehouseId, $productId) {
    $inventory = Inventory::where('product_id', $productId)->where('warehouse_id', $warehouseId)->first();
    request()->validate([
        'quantity' => ['required', 'numeric', 'min:1', 'gt:'.$inventory->quantity],
    ]);

    return redirect('/warehouses/'.$warehouseId);
});
