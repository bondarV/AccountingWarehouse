<?php

namespace App\Http\Requests;

use App\Rules\AdjustingDifferentValueRule;
use App\Models\Inventory;
use Illuminate\Foundation\Http\FormRequest;

class AdjustOperationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $inventory = Inventory::find($this->input('inventory_id'));

        return [
            'quantity' => [
                'required',
                'integer',
                'gte:0',
                ...( $inventory ? [new AdjustingDifferentValueRule($inventory->quantity)] : [] ),
            ],
        ];
    }
}
