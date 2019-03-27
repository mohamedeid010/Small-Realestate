<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
  protected $fillable = ['name', 'datefrom', 'dateto', 'price','realestate_id'];
    public function realstate()
    {
      return $this->belongsTo('App\Realestate');
    }
}
