<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class WarehouseTransportationDestinationRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function __construct(protected int $currentWarehouseId)
    {

    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if($value === $this->currentWarehouseId) {
            $fail('Warehouse cannot be relocated to not another warehouse.');
        }
    }
}
