<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cuisine extends Model
{
    protected $table = 'cuisines';

    protected $fillable = [
        'name',
        'status',
    ];

    public function prospectPreferences()
    {
        return $this->belongsToMany(
            ProspectPreference::class,
            'prospect_preferences_cuisine',
            'cuisine_id',
            'prospect_preferences_id'
        );
    }
}
