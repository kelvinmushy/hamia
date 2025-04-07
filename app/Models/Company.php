<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'phone_number',
        'email',
        'logo',
    ];

    public function location()
    {
        return $this->hasOne(CompanyLocation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company_social_media()
    {
        return  $this->hasMany('App\Models\CompanySocialMedia');
    }

     public function property(){
        return  $this->hasMany('App\Models\Property');
    } 
     

}
