<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\County;

class SubCounty extends Model
{
  function county(){
    return $this->belongsTo('App\County');
  }

  function scopeCounty($query,$county){
    $county_id = County::whereName($county)->first()->id;

    return $query->where('county_id',$county_id);
  }

  function wards(){
    return $this->hasMany('App\Ward');
  }
}
