<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProspectPurchase extends Model
{
    protected $table = 'prospect_purchase';

    protected $fillable = [
        'prospect_id',
        'monthly_budget',
        'purchase_frequency',
        'status',
    ];

    public function days()
    {
        return $this->hasMany(
            ProspectPurchaseDay::class,
            'prospect_purchase_id'
        );
    }
}
