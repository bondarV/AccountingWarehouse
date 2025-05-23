<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Warehouse;

class InventoryController extends Controller
{
    public function index(Warehouse $warehouse)
    {
        $inventory = Inventory::with('product', 'warehouse')->where('warehouse_id', $warehouse->id)->cursorPaginate(5);

        return view('warehouses.inventory.index', ['products' => $inventory, 'warehouse' => $warehouse]);
    }
}
