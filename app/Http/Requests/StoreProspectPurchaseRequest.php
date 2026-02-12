<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\WeekDay;

class StoreProspectPurchaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'prospect_id' => 'required|exists:prospect_personal,id',

            'monthly_budget' => 'nullable|numeric|min:0',

            'purchase_frequency' =>
                'nullable|in:Once a month,Once a week,Several days a week,Daily',

            // pivot days
            'purchase_days' => 'required|array|min:1',
            'purchase_days.*' =>
                'integer|in:' . implode(',', WeekDay::all()),
        ];
    }
}
