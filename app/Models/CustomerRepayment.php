<?php
// app/Models/ProjectRepayment.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerRepayment extends Model
{
    use HasFactory;

    protected $fillable = [

        'customer_id',
        'project_id',
        'payment_date',
        'payment_amount',
        'payment_method',
        'remaining_balance'
        
    ];

    // Relationship with the Project model
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
