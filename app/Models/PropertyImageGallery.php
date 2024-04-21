<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyImageGallery extends Model
{
    protected $fillable = ['property_id', 'name', 'size','path'];

    public function property()
    {
        return $this->belongsTo('App\Property');
    }
}


