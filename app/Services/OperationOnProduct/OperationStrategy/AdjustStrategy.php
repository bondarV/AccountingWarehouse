<?php

namespace App\Services\OperationOnProduct\OperationStrategy;

use App\Enums\MovementType;
use App\Models\Inventory;
use App\Models\StockMovement;
use App\Rules\AdjustingDifferentValueRule;
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

        $changed_quantity = $this->operationHelper->verifyQuantityMovement(
            $request->get('quantity'),
            $inventory->quantity
        );

        $this->operationHelper->storeNewUtility(
            StockMovement::class,
            [
                'product_id'    => $request->get('product_id'),
                'quantity'      => $changed_quantity,
                'warehouse_id'  => $request->get('warehouse_id'),
                'movement_type' => $request->get('movement_type'),
            ]
        );

        $this->operationHelper->updateUtility(
            $inventory,
            ['quantity' => $request->get('quantity')]
        );
    }
}
