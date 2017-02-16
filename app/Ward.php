<?php

namespace App;

use App\County;
use App\SubCounty;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
  protected $table='wards';
  protected $fillable=['name','sub_county_id','county_id'];

  function county(){
    return $this->belongsTo('App\County');
  }

  function scopeCounty($query,$county){
    $county_id = County::whereName($county)->first()->id;

    return $query->where('county_id',$county_id);
  }

  function subcounty(){
    return $this->belongsTo('App\County');
  }

  function scopeSubCounty($query,$sub_county){
    $sub_county_id = SubCounty::whereName($sub_county)->first()->id;

    return $query->where('sub_county_id',$sub_county_id);
  }
}
