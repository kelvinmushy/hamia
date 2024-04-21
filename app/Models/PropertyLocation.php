<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyLocation extends Model
{
    //
    protected $fillable=['region_id','property_id',
    'name','latitude','longitude','address','district_id'];


    public function region(){
        return $this->belongsTo('App\Models\Region','region_id');
    }
   
}
