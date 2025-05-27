<?php

namespace App\Http\Controllers;

use App\Enums\MovementType;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\StockMovement;
use App\Models\Warehouse;
use App\Services\OperationProcessService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

        $warehouses = Warehouse::where('id','!=',$warehouse->id)->get();

        $key_warehouse = $warehouse;
        return view('warehouses.operations.create', ['inventory' => $inventory, 'operations' => MovementType::cases(), 'warehouses' => $warehouses, 'key_warehouse' => $key_warehouse]);
    }

    public function store(Warehouse $warehouse, Product $product, Request $request)
    {
        $inventory = Inventory::where('warehouse_id', $warehouse->id)->where('product_id', $product->id)->first();

        $request->merge([
            'warehouse_id'=>$warehouse->id,
            'product_id' => $product->id,
            'inventory_id' => $inventory->id,
        ]);


        $request->validate([
            'movement_type' => [Rule::enum(MovementType::class)],
            'quantity' => ['gte:0','required',],
            'reason' => ['nullable', 'max:255'],
        ]);

        $this->operationService->performOperation($request);

        session()->forget('current_movement_type');
        return redirect('/warehouses/' . $request->get('warehouse_id'))->with('success', 'The operation was created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }
}
