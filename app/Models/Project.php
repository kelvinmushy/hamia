<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name', 'type', 'size_in_sq_m', 'residential_size', 'farm_size', 
        'payment_type', 'price', 'amount_paid', 
        'installment_period', 'installment_amount', 'company_id'
    ];


      // 🔹 One Project has One Location
    public function location()
    {
        return $this->hasOne(ProjectLocation::class);
    }

    // 🔹 One Project has Many Payments
    public function payments()
    {
        return $this->hasOne(ProjectPayment::class);
    }
    
    public function repayments()
    {
        return $this->hasMany(ProjectRepayment::class);
    }
    
}
