<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    function sub_counties(){
      return $this->hasMany('App\SubCounty');
    }

    function wards(){
      return $this->hasMany('App\Ward');
    }
}
