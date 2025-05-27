<?php

namespace App\Services;

use App\Enums\MovementType;
use App\Services\OperationStrategy\AdjustStrategy;
use App\Services\OperationStrategy\RelocateStrategy;
use App\Services\OperationStrategy\SellingStrategy;
use Illuminate\Http\Request;

class OperationProcessService
{
    public function performOperation(Request $request)
    {
        $operationHelper = new OperationHelper();

        $strategy = match (strtolower($request->input('movement_type'))) {
            MovementType::ADJUST->value => new AdjustStrategy($operationHelper),
            MovementType::OUT->value => new SellingStrategy($operationHelper),
            MovementType::RELOCATE->value => new RelocateStrategy($operationHelper),
        };
        //I don't need to dynamically alter or modify my algorithm logic
        $strategy->populateData($request);
    }
}
