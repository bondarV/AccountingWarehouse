<?php

use App\Enums\MovementType;
use App\Http\Controllers\WarehouseController;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Route;

Route::view('/', 'about');

Route::get('/warehouses', function () {
    $warehouses = Warehouse::cursorPaginate(5);

    return view('warehouses.index', ['warehouses' => $warehouses]);
});

Route::get('/products', function () {
    $products = Product::cursorPaginate(5);

    return view('products.index', ['products' => $products]);
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
Route::get('/warehouses/{id}/inventory', function ($id) {
    $inventory = Inventory::with('warehouse', 'product')
        ->where('warehouse_id', $id)
        ->cursorPaginate(5);
    $warehouse = Warehouse::find($id);

    return view('warehouses.inventories.index', ['inventory' => $inventory, 'warehouse' => $warehouse]);
});

Route::get('/products/{id}', function ($id) {
    $general_quantity = Inventory::where('product_id', $id)->get()->sum('quantity');
    $product = Product::find($id);

    if (! $product) {
        abort(404);
    }

    $warehouses = $product->warehouses()
        ->withPivot('quantity')
        ->paginate(5);



    return view('products.show', ['product' => $product, 'general_quantity' => $general_quantity, 'warehouses' => $warehouses]);
});

Route::get('/warehouses/{id}', function ($id) {
    $warehouse = Warehouse::with(['products' => function ($query) {
        $query->withPivot('quantity');
    }])->find($id);
    $items = Inventory::with('warehouse', 'product')
        ->where('warehouse_id', $id)
        ->cursorPaginate(5);

    return view('warehouses.show', [
        'items' => $items,
        'warehouse' => $warehouse,
    ]);
});
// Route::resource('warehouses', WarehouseController::class);
