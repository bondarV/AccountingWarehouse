<?php

namespace App\Services\OperationOnProduct\OperationStrategy;

use App\Enums\MovementType;
use App\Models\Inventory;
use App\Models\Purchase;
use App\Models\StockMovement;
use App\Models\User;
use App\Rules\UserExistenceRule;
use Illuminate\Http\Request;

class SellingStrategy implements IOperationStrategy
{


    public function populateData(Request $request)
    {
        session(['current_movement_type' => MovementType::OUT->value]);

        $inventory = Inventory::find($request->input('inventory_id'));

        $request->validate([
            'quantity' => ['lte:' . $inventory->quantity],
            'customer_email' => ['email', 'required', new UserExistenceRule()],
        ]);

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

        Purchase::create([
            'warehouse_id' => $request->get('warehouse_id'),
            'user_id' => User::where('email', $request->input('customer_email'))->first()->id,
            'quantity' => $request->get('quantity'),
        ]);
    }
}
