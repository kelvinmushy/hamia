<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyCurrency extends Model
{
    //
    protected $fillable=['currency_id','property_id'];

    public function currency(){
        return $this->belongsTo('App\Models\Currency','currency_id');
    }
}
