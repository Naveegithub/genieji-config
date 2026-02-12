<?php

namespace App\Models;
//use App\Models\PreferencesLifestyle;

use Illuminate\Database\Eloquent\Model;

class Prospect extends Model
{
    protected $fillable = ['name', 'mobile',  'user_id'];

    /* STEP 1 */
  public function address()
{
    return $this->hasOne(ProspectPersonal::class);
}


    /* STEP 2 */
    public function household()
    {
        return $this->hasOne(ProspectHousehold::class);
    }

    /* STEP 3 */
 public function preferencesLifestyle()
    {
        return $this->hasOne(ProspectPreference::class, 'prospect_id');
    }
    /* STEP 4 */
    public function budget()
    {
        return $this->hasOne(ProspectPurchase::class);
    }

   
}
