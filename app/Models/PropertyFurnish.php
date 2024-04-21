<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyFurnish extends Model
{
    //
    protected $fillable=['furnish_id','property_id'];


    public function furnish(){
        return $this->belongsTo('App\Models\Furnish','furnish_id');
    }
    
}
