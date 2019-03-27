<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Realestate extends Model
{
    public function details()
    {
      return $this->belongsToMany('App\Detail');
    }
    public function seasons()
    {
      return $this->hasMany('App\Season');
    }
}
