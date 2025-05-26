<?php

namespace App\Services\OperationOnProduct\OperationStrategy;

use App\Enums\MovementType;
use App\Models\Inventory;
use App\Models\StockMovement;
use Illuminate\Http\Request;

class AdjustStrategy implements IOperationStrategy
{

    public function populateData(Request $request)
    {
        session(['current_movement_type' => MovementType::ADJUST->value]);

        $inventory = Inventory::find($request->get('inventory_id'));

        $request->validate([
            'quantity' =>
                function ($attribute, $value, $fail) use ($inventory) {
                    if ($value === (string)$inventory->quantity) {
                        $fail("Let's stop doing redundant work! (you didn't intent to change quantity)");
                    }
                }
        ]);

        $inventory = Inventory::find($request->get('inventory_id'));
        $changed_quantity = $request->get('quantity') - $inventory->quantity;
        if ($changed_quantity > 0) {
            $changed_quantity = '+' . str($changed_quantity);
        }
        StockMovement::create([
                'product_id' => $request->get('product_id'),
                'quantity' => $changed_quantity,
                'warehouse_id' => $request->get('warehouse_id'),
                'movement_type' => $request->get('movement_type'),
            ]
        );
        $inventory->update([
            'quantity' => $request->get('quantity')
        ]);

    }
}
