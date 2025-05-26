<?php

namespace App\Services\OperationOnProduct\OperationStrategy;

use App\Models\Inventory;
use App\Models\StockMovement;
use Illuminate\Http\Request;

class AdjustStrategy implements IOperationStrategy
{

    public function populateData(Request $request)
    {
        $stockMovement = new StockMovement();

        StockMovement::create([
                'product_id' => $request->get('product_id'),
                'quantity' => $request->get('quantity'),
                'warehouse_id' => $request->get('warehouse_id'),
                'movement_type' => $request->get('movement_type'),
            ]
        );
        $inventory = Inventory::find($request->get('inventory_id'));
        $inventory->update([
            'quantity' => $request->get('quantity')
        ]);

    }
}
