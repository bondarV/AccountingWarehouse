<?php

namespace App\Services\OperationOnProduct\OperationStrategy;

use Illuminate\Http\Request;

interface IOperationStrategy
{
    public function populateData(Request $request);
}
