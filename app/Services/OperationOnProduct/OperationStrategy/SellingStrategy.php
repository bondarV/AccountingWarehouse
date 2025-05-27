<?php

namespace App\Services\OperationOnProduct\OperationStrategy;

use App\Enums\MovementType;
use App\Models\Inventory;
use App\Models\Purchase;
use App\Models\User;
use App\Rules\UserExistenceRule;
use Illuminate\Http\Request;

class SellingStrategy extends OperationStrategy
{
    public function populateData(Request $request)
    {
        session(['current_movement_type' => MovementType::OUT->value]);

        $inventory = Inventory::find($request->input('inventory_id'));

        $request->validate([
            'quantity' => ['lte:' . $inventory->quantity],
            'customer_email' => ['email', 'required', new UserExistenceRule()],
        ]);

        $changed_quantity = $this->operationHelper->verifyQuantityMovement(
            $request->get('quantity'),
            $inventory->quantity
        );

        $this->operationHelper->storeNewUtility(
            class: \App\Models\StockMovement::class,
            fields: [
                'product_id'    => $request->get('product_id'),
                'quantity'      => $changed_quantity,
                'warehouse_id'  => $request->get('warehouse_id'),
                'movement_type' => $request->get('movement_type'),
            ]
        );

        $this->operationHelper->updateUtility(
            model: $inventory,
            fields: ['quantity' => $request->get('quantity')],
        );

        $user = User::where('email', $request->input('customer_email'))->first();

        $this->operationHelper->storeNewUtility(
            class: Purchase::class,
            fields: [
                'warehouse_id' => $request->get('warehouse_id'),
                'user_id'      => $user?->id,
                'quantity'     => $request->get('quantity'),
            ]
        );
    }
}
