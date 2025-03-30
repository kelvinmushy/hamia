<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyTerm extends Model
{
    //
    protected $fillable=['term_id','property_id','creator_id','updator_id'];


     public function term()
    {
        return  $this->belongsTo('App\Models\Term', 'term_id');
    }
}
