<?php

namespace App\Services\OperationOnProduct\OperationStrategy;

use Illuminate\Http\Request;

class AdjustStrategy implements IOperationStrategy
{

    public function populateData(Request $request)
    {
        dd($request->input('warehouse_id'));

    }
}
