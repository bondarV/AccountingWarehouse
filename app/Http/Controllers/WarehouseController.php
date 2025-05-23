<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Warehouse;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $warehouses = Warehouse::cursorPaginate(5);

        return view('warehouses.index', ['warehouses' => $warehouses]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Warehouse $warehouse)
    {
        $items = Inventory::with('warehouse', 'product')
            ->where('warehouse_id', $warehouse->id)
            ->cursorPaginate(5);

        return view('warehouses.show', [
            'items' => $items,
            'warehouse' => $warehouse,
        ]);
    }
}
