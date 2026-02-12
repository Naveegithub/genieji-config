<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\DietaryPreference;
use App\Enums\ValueSensitivity;

class StoreProspectPreferenceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'prospect_id' => 'required|exists:prospect_personal,id',

            'dietary_preference' =>
                'required|in:' . implode(',', DietaryPreference::all()),

            'is_health_conscious' => 'boolean',
            'is_fitness_gym_going' => 'boolean',
            'is_kids_nutrition_focused' => 'boolean',
            'is_elderly_care_focused' => 'boolean',
            'is_weight_management' => 'boolean',

            'pref_jain_food' => 'boolean',
            'pref_satvik_food' => 'boolean',
            'pref_no_onion_no_garlic' => 'boolean',

            'value_sensitivity' =>
                'nullable|in:' . implode(',', ValueSensitivity::all()),

            // 🔥 pivot
            'cuisine_ids' => 'required|array|min:1',
            'cuisine_ids.*' => 'exists:cuisines,id',
        ];
    }
}
