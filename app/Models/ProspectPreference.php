<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProspectPreference extends Model
{
    protected $table = 'prospect_preferences';

    protected $fillable = [
        'prospect_id',
        'dietary_preference',

        'is_health_conscious',
        'is_fitness_gym_going',
        'is_kids_nutrition_focused',
        'is_elderly_care_focused',
        'is_weight_management',

        'pref_jain_food',
        'pref_satvik_food',
        'pref_no_onion_no_garlic',

        'value_sensitivity',
        'status',
    ];

  public function cuisines()
{
    return $this->belongsToMany(
        Cuisine::class,
        'prospect_preferences_cuisine',
        'prospect_preferences_id',
        'cuisine_id'
    );
}

}
