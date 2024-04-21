<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeatureProperty extends Model
{
    protected $fillable = [
        'property_id','feature_id'
    ];

 
  
      public function features()
    {
        return  $this->belongsTo('App\Models\Feature', 'feature_id');
      //  return $this->belongsToMany(::class)->withTimestamps();
    }
}
