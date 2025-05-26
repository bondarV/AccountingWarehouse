<?php

namespace App\Http\Controllers;

use App\Enums\MovementType;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\StockMovement;
use App\Models\Warehouse;
use App\Services\OperationOnProduct\OperationProcessService;
use Illuminate\Http\Request;

class OperationController extends Controller
{
    public function __construct(protected OperationProcessService $operationService)
    {
    }

//    public function index(Warehouse $warehouse, Product $product)
//    {
//        $inventory = Inventory::where('warehouse_id', $warehouse->id)->where('product_id', $product->id)->first();
//
//
//        $warehouses = Warehouse::all();
//        return view('warehouses.operations.create', ['inventory' => $inventory, 'operations' => MovementType::cases(), 'warehouses' => $warehouses]);
//    }

    public function create(Warehouse $warehouse, Product $product)
    {
        $inventory = Inventory::where('warehouse_id', $warehouse->id)->where('product_id', $product->id)->first();

        $operations = StockMovement::where('warehouse_id', $warehouse->id)->where('product_id', $product->id)->first();

        $warehouses = Warehouse::all();

        $key_warehouse = $warehouse;
        return view('warehouses.operations.create', ['inventory' => $inventory, 'operations' => MovementType::cases(), 'warehouses' => $warehouses, 'key_warehouse' => $key_warehouse]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Warehouse $warehouse, Product $product, Request $request)
    {
        $request->merge([
            'warehouse_id'=>$warehouse->id,
            'product_id' => $product->id
        ]);

        $this->operationService->performOperation($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }
}
