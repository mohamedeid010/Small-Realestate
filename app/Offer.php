<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    public function realestate()
    {
      return $this->hasOne('App\Realestate');
    }
}
