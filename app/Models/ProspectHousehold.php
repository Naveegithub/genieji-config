<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProspectHousehold extends Model
{
    protected $table = 'prospect_household';

    protected $fillable = [
        'prospect_id',
        'household_size',
        'male_count',
        'female_count',
        'infants',
        'children',
        'adults',
        'seniors',
        'auto_tags',
        'status',
    ];

    public function prospect()
    {
        return $this->belongsTo(ProspectPersonal::class, 'prospect_id');
    }
}
