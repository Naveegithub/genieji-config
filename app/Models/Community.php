<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    protected $fillable = ['city_id', 'community_name', 'status'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
