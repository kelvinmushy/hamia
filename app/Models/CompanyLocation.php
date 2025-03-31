<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'district_id',
        'sub_location',
        'updator_id',
        'creator_id',
    ];

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }
    
}
