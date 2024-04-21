<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyNearBy extends Model
{
    protected $fillable = [
        'property_id','near_by_id'
    ];

    public function near_by(){
        return $this->belongsTo('App\Models\NearBye','near_by_id');
    }
}
