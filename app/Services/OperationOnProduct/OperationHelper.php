<?php

namespace App\Services\OperationOnProduct;

use App\Models\StockMovement;

class OperationHelper
{
    public function verifyQuantityMovement($sendQuantity, $stateQuantity): string
    {
        // If we want to lose or get quantity for specific warehouse
        $changed_quantity = $sendQuantity - $stateQuantity;

        if ($changed_quantity > 0) {
            return $changed_quantity = '+' . str($changed_quantity);
        }
        return $changed_quantity;
    }

    public function storeNewStockMovement($productId, $changedQuantity,$warehouseId, $movementType) : void
    {
        StockMovement::create([
                'product_id' => $productId,
                'quantity' => $changedQuantity,
                'warehouse_id' => $warehouseId,
                'movement_type' => $movementType,
            ]
        );
    }
}
