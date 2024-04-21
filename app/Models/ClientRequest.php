<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientRequest extends Model
{
    protected $fillable = ['fullname','district_id','phone_number','property_title','property_price','sub_location'];


    public function districts()
    {

        return $this->belongsTo(District::class,'district_id');
    }
}
