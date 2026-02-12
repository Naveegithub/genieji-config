<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommunityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // State
            'state.name' => 'required|string|max:100',

            // City
            'city.name' => 'required|string|max:100',

            // Community
            'community.community_name' => 'required|string|max:150',
        ];
    }
}
