<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable = ['category_id','name'];


    public function category()
    {
        return  $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function properties()
    {
        return  $this->hasMany('App\Models\Property', 'sub_category_id');
    }
}
