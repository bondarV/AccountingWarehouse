<?php

namespace App\Services\OperationOnProduct\OperationStrategy;

use App\Services\OperationOnProduct\OperationHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

abstract class OperationStrategy
{
    public function __construct(protected OperationHelper $operationHelper)
    {

    }

    public abstract function populateData(FormRequest $request);
}
