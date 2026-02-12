<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProspectPurchaseDay extends Model
{
    protected $table = 'prospect_purchase_days';

    protected $fillable = [
        'prospect_purchase_id',
        'day',
    ];

    public $timestamps = false;
}
