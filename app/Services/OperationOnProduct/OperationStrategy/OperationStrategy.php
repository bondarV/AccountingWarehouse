<?php

namespace App\Services\OperationOnProduct\OperationStrategy;

use App\Services\OperationOnProduct\OperationHelper;
use Illuminate\Http\Request;

abstract class OperationStrategy
{
    public function __construct(protected OperationHelper $operationHelper)
    {

    }

    abstract public function populateData(Request $request);
}
