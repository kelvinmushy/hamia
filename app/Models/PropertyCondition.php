<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyCondition extends Model
{
    //
    protected $fillable=['condition_id','property_id'];


    
    public function condition(){
        return $this->belongsTo('App\Models\Condition','condition_id');
    }

    public function property(){
        return $this->belongsTo('App\Models\Property','property_id');
    }


}
