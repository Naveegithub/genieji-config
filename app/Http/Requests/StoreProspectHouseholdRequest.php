<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProspectHouseholdRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'prospect_id'    => 'required|exists:prospect_personal,id',

            'household_size' => 'required|integer|min:1',

            'male_count'     => 'nullable|integer|min:0',
            'female_count'   => 'nullable|integer|min:0',

            'infants'        => 'nullable|integer|min:0',
            'children'       => 'nullable|integer|min:0',
            'adults'         => 'nullable|integer|min:0',
            'seniors'        => 'nullable|integer|min:0',

            'auto_tags'      => 'nullable|string',
        ];
    }
}
