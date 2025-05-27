<?php

namespace App\Services\OperationOnProduct\OperationStrategy;

use App\Enums\MovementType;
use App\Models\Inventory;
use App\Models\Purchase;
use App\Models\StockMovement;
use App\Models\User;
use App\Rules\UserExistenceRule;
use Illuminate\Http\Request;

class SellingStrategy extends OperationStrategy
{


    public function populateData(Request $request)
    {
        session(['current_movement_type' => MovementType::OUT->value]);

        $inventory = Inventory::find($request->input('inventory_id'));
        // YAGNI Principle,'cause i realize that is unlikely to reuse this part,however separating violates KISS
        $request->validate([
            'quantity' => ['lte:' . $inventory->quantity],
            'customer_email' => ['email', 'required', new UserExistenceRule()],
        ]);

        $changed_quantity = $this->operationHelper->verifyQuantityMovement($request->get('quantity'), $inventory->quantity);

        $this->operationHelper->storeNewStockMovement(productId: $request->get('product_id'),changedQuantity:$changed_quantity,warehouseId:$request->get('warehouse_id'),movementType: $request->get('movement_type') );


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
