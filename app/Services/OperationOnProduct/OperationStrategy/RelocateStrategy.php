<?php

namespace App\Services\OperationOnProduct\OperationStrategy;

use App\Enums\MovementType;
use App\Models\Inventory;
use App\Models\StockMovement;
use App\Rules\WarehouseTransportationDestinationRule;
use Illuminate\Http\Request;

class RelocateStrategy extends OperationStrategy
{

    public function populateData(Request $request)
    {
        session(['current_movement_type' => MovementType::RELOCATE->value]);

        $inventory = Inventory::find($request->get('inventory_id'));
        //KISS
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

        $this->operationHelper->storeNewStockMovement(productId: $request->get('product_id'),changedQuantity: '-'.$request->get('quantity'),warehouseId:$request->get('warehouse_id'),movementType: $request->get('movement_type') );

        $this->operationHelper->storeNewStockMovement(productId: $request->get('product_id'),changedQuantity: '+'.$request->get('quantity'),warehouseId:$request->get('destination_warehouse_id'),movementType: $request->get('movement_type') );

    }
}
