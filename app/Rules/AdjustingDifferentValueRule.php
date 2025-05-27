<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AdjustingDifferentValueRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */

    public function __construct(protected int $initialQuantity)
    {

    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ((int) $value === $this->initialQuantity) {
            $fail("Let's stop doing redundant work! (you didn't intent to change quantity)");
        }
    }
}
