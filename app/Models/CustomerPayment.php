<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerPayment extends Model
{
    use HasFactory;

    // Define the table name if it's not pluralized correctly
    protected $table = 'customer_payments'; // Update this with your actual table name

    // The attributes that are mass assignable
    protected $fillable = [
        'customer_id',
        'division_id',
        'payment',
    ];

    // Define the relationships
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function division()
    {
        return $this->belongsTo(ProjectDivision::class);
    }
}
