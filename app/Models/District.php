<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
    //use SoftDeletes;
    protected $fillable = ['name','region_id','slug'];
    
    public function region(){
        return $this->belongsTo('App\Models\Region','region_id');
    }

    // public function user(){
    //     return $this->belongsTo('App\Models\Universals\User','creator_id');
    // }
    // public function client_addresse(){
        
    //     return $this->belongsTo(\App\Models\Clients\ClientAddress::class);
    // }
  
   
}
