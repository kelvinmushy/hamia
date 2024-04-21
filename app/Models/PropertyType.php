<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    protected $fillable = [
        'region_id',
        'name'
    ];
     public function sub_category()
    {
        return  $this->belongsTo('App\Models\SubCategory', 'sub_category_id');
    }
}
