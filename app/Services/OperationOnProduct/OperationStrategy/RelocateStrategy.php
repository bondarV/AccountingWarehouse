<?php

namespace App\Services\OperationOnProduct\OperationStrategy;

use App\Enums\MovementType;
use App\Models\Inventory;
use App\Models\StockMovement;
use App\Rules\WarehouseTransportationDestinationRule;
use Illuminate\Http\Request;

class RelocateStrategy implements IOperationStrategy
{

    public function populateData(Request $request)
    {
        session(['current_movement_type' => MovementType::RELOCATE->value]);

        $inventory = Inventory::find($request->get('inventory_id'));

        $request->validate([
            'quantity' => ['lte:' . $inventory->quantity],
            'destination_warehouse_id' => ['required', new WarehouseTransportationDestinationRule($request->get('warehouse_id'))],
        ]);

        if ((int)$request->input('quantity') === $inventory->quantity) {
            $inventory->update(['warehouse_id' => $request->get('destination_warehouse_id'),]);
        } else {
            Inventory::create([
                'warehouse_id' => $request->get('destination_warehouse_id'),
                'quantity' => $request->get('quantity'),
                'product_id' => $request->get('product_id'),
            ]);
            $inventory->update([
                'quantity' => $inventory->quantity - $request->get('quantity'),
            ]);
        }

        StockMovement::create([
                'product_id' => $request->get('product_id'),
                'quantity' => '-' . $request->get('quantity'),
                'warehouse_id' => $request->get('warehouse_id'),
                'movement_type' => $request->get('movement_type'),
            ]
        );

        StockMovement::create([
                'product_id' => $request->get('product_id'),
                'quantity' => '+' . $request->get('quantity'),
                'warehouse_id' => $request->get('destination_warehouse_id'),
                'movement_type' => $request->get('movement_type'),
            ]
        );
    }
}
