<?php

namespace App\Services\OperationOnProduct\OperationStrategy;

use App\Enums\MovementType;
use App\Models\Inventory;
use App\Models\StockMovement;
use App\Rules\AdjustingDifferentValueRule;
use App\Services\OperationOnProduct\OperationHelper;
use Illuminate\Http\Request;

class AdjustStrategy extends OperationStrategy
{

    public function populateData(Request $request)
    {
        session(['current_movement_type' => MovementType::ADJUST->value]);

        $inventory = Inventory::find($request->get('inventory_id'));

        $request->validate([
            'quantity' => [new AdjustingDifferentValueRule($inventory->quantity)],
        ]);

        $changed_quantity = $this->operationHelper->verifyQuantityMovement($request->get('quantity'), $inventory->quantity);
        $this->operationHelper->storeNewStockMovement(productId: $request->get('product_id'),changedQuantity: $changed_quantity,warehouseId:$request->get('warehouse_id'),movementType: $request->get('movement_type') );

        $inventory->update([
            'quantity' => $request->get('quantity')
        ]);

    }
}
