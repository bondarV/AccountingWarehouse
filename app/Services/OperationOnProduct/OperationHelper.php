<?php

namespace App\Services\OperationOnProduct;

class OperationHelper
{
    public function verifyQuantityMovement($sendQuantity, $stateQuantity): string
    {
        $changed_quantity = $sendQuantity - $stateQuantity;

        if ($changed_quantity > 0) {
            return '+' . str($changed_quantity);
        }
        return (string) $changed_quantity;
    }

    public function storeNewUtility($class, array $fields): void
    {
        $class::create($fields);
    }

    public function updateUtility($model, array $fields): void
    {
        $model->update($fields);
    }
}
