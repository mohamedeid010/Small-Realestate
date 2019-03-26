<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    public function realestates()
    {
      return $this->belongsToMany('App\Realestate');
    }
}
