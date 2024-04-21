<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
    protected $fillable=['name','slug'];

    public function regions()
    {
        return $this->hasMany('App\Models\Region', 'country_id');
    }
}
