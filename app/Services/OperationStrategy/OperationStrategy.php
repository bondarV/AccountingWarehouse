<?php

namespace App\Services\OperationStrategy;

use App\Services\OperationHelper;
use Illuminate\Http\Request;

abstract class OperationStrategy
{
    public function __construct(protected OperationHelper $operationHelper)
    {

    }

    abstract public function populateData(Request $request);
}
