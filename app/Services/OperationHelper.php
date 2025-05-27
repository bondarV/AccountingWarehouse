<?php

namespace App\Services;

use App\Models\Inventory;
use Illuminate\Http\Request;

class OperationHelper
{
    public function verifyQuantityMovement($sendQuantity, $stateQuantity): string
    {
        $changed_quantity = $sendQuantity - $stateQuantity;

        if ($changed_quantity > 0) {
            return '+' . str($changed_quantity);
        }
        return (string) $changed_quantity;
    }

    public function storeNewUtility($class, array $fields): void
    {
        $class::create($fields);
    }

    public function updateUtility($model, array $fields): void
    {
        $model->update($fields);
    }
    public function setMovementType($type) : void
    {
        session(['current_movement_type' => $type]);
    }
    public function getInventory(Request $request): ?Inventory
    {
        return Inventory::find($request->get('inventory_id'));
    }
}
