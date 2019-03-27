<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    public function realstate()
    {
      return $this->belongsTo('App\Realestate');
    }
}
