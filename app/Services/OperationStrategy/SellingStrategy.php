<?php

namespace App\Services\OperationStrategy;

use App\Enums\MovementType;
use App\Models\Purchase;
use App\Models\StockMovement;
use App\Models\User;
use App\Rules\UserExistenceRule;
use App\Services\OperationHelper;
use Illuminate\Http\Request;

class SellingStrategy extends OperationStrategy
{
    public function __construct(OperationHelper $operationHelper)
    {

        parent::__construct($operationHelper);
        $this->operationHelper->setMovementType(MovementType::RELOCATE->value);

    }

    public function populateData(Request $request)
    {
        $inventory = $this->operationHelper->getInventory($request);

        $request->validate([
            'quantity' => ['lte:' . $inventory->quantity],
            'customer_email' => ['email', 'required', new UserExistenceRule()],
        ]);

        $changed_quantity = $this->operationHelper->verifyQuantityMovement(
            $request->get('quantity'),
            $inventory->quantity
        );

        $this->operationHelper->storeNewUtility(
            class: StockMovement::class,
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
                'product_id'    => $request->get('product_id'),
                'user_id'      => $user?->id,
                'quantity'     => $request->get('quantity'),
            ]
        );
    }
}
