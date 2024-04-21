<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyImage extends Model
{
    protected $fillable = ['property_id', 'name'];

    public function property()
    {
        return $this->belongsTo('App\Property');
    }
}


