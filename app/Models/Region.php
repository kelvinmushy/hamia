<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Region extends Model
{
    //use SoftDeletes;
    protected $fillable = ['name','country_id','slug'];
    
    public function country(){
        return $this->belongsTo('App\Models\Country','country_id');
    }

    // public function user(){
    //     return $this->belongsTo('App\Models\Universals\User','creator_id');
    // }
    // public function client_addresse(){
        
    //     return $this->belongsTo(\App\Models\Clients\ClientAddress::class);
    // }
  
   
}
