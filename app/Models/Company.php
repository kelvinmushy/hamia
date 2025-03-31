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

}
