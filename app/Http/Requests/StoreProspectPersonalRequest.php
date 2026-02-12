<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProspectPersonalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',

            'mobile' => [
                'required',
                'regex:/^[6-9][0-9]{9}$/'
            ],

            'customer_id' => 'nullable|exists:users,id',

            'community_id' => 'required|exists:communities,id',

            'flat_no' => 'required|string|max:50',
            'floor' => 'nullable|string|max:50',
            'block_street' => 'nullable|string|max:255',

            'gps_location' => 'nullable|string|max:100',

            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',

            'remarks' => 'nullable|string|max:255',
        ];
    }
}
