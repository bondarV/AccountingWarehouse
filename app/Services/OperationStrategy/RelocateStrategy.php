<?php
namespace App\Services\OperationStrategy;

use App\Enums\MovementType;
use App\Models\Inventory;
use App\Models\StockMovement;
use App\Rules\WarehouseTransportationDestinationRule;
use App\Services\OperationHelper;
use Illuminate\Http\Request;

class RelocateStrategy extends OperationStrategy
{
    public function __construct(OperationHelper $operationHelper)
    {
        parent::__construct($operationHelper);
        $this->operationHelper->setMovementType(MovementType::RELOCATE->value);

    }
    public function populateData(Request $request)
    {

        $inventory = Inventory::find($request->get('inventory_id'));

        $request->validate([
            'quantity' => ['lte:' . $inventory->quantity],
            'destination_warehouse_id' => ['required', new WarehouseTransportationDestinationRule($request->get('warehouse_id'))],
        ]);


        if ((int)$request->input('quantity') === $inventory->quantity) {
            $this->operationHelper->updateUtility(
                model: $inventory,
                fields: ['warehouse_id' => $request->get('destination_warehouse_id')]
            );
        } else {

            $this->operationHelper->storeNewUtility(
                class: Inventory::class,
                fields: [
                    'warehouse_id' => $request->get('destination_warehouse_id'),
                    'quantity'     => $request->get('quantity'),
                    'product_id'   => $request->get('product_id'),
                ]
            );

            $this->operationHelper->updateUtility(
                model: $inventory,
                fields: ['quantity' => $inventory->quantity - $request->get('quantity')]
            );
        }


        $this->operationHelper->storeNewUtility(
            class: StockMovement::class,
            fields: [
                'product_id'    => $request->get('product_id'),
                'quantity'      => '-' . $request->get('quantity'),
                'warehouse_id'  => $request->get('warehouse_id'),
                'movement_type' => $request->get('movement_type'),
            ]
        );

        $this->operationHelper->storeNewUtility(
            class: StockMovement::class,
            fields: [
                'product_id'    => $request->get('product_id'),
                'quantity'      => '+' . $request->get('quantity'),
                'warehouse_id'  => $request->get('destination_warehouse_id'),
                'movement_type' => $request->get('movement_type'),
            ]
        );
    }
}
