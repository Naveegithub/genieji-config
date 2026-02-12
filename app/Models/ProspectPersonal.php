<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProspectPersonal extends Model
{
     protected $table = 'prospect_personal'; 

    protected $fillable = [
        'name',
        'mobile',
        'customer_id',
        'community_id',
        'flat_no',
        'floor',
        'block_street',
        'gps_location',
        'latitude',
        'longitude',
        'remarks',
        'version',
        'status',
    ];

    public function community()
    {
        return $this->belongsTo(Community::class);
    }
}
