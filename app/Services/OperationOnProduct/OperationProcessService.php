<?php

namespace App\Services\OperationOnProduct;

use App\Enums\MovementType;
use App\Services\OperationOnProduct\OperationStrategy\AdjustStrategy;
use App\Services\OperationOnProduct\OperationStrategy\RelocateStrategy;
use App\Services\OperationOnProduct\OperationStrategy\SellingStrategy;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isTrue;

class OperationProcessService
{
    public function performOperation(Request $request)
    {
        $strategy = match (strtolower($request->input('movement_type'))) {
            MovementType::ADJUST->value => new AdjustStrategy,
            MovementType::OUT->value => new SellingStrategy,
            MovementType::RELOCATE->value => new RelocateStrategy
        };

        $strategy->populateData($request);
    }
}
