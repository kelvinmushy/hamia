<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'phone_number',
        'email',
        'district_id',
        'address',
        'company_id',
    ];

    // A Customer belongs to a District
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    // A Customer belongs to a Company
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // If a Customer has many repayments (optional but often used)
    public function repayments()
    {
        return $this->hasMany(CustomerRepayment::class);
    }
}
