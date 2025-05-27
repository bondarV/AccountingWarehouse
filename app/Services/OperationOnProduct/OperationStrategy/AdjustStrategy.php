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
    public function __construct(OperationHelper $operationHelper)
    {
        parent::__construct($operationHelper);
        $this->operationHelper->setMovementType(MovementType::ADJUST->value);

    }
    public function populateData(Request $request)
    {
        $inventory = $this->operationHelper->getInventory($request);

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
