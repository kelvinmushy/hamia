<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectPayment extends Model
{
    use HasFactory;

    // Table name (optional if follows Laravel naming convention)
    protected $table = 'project_payments';

    // Mass assignable attributes
    protected $fillable = [
        'project_id',
        'payment_type',
        'total_price',
        'amount_paid',
        'installment_period',
        'installment_amount',
        'payment_status',
    ];

    // Payment types
    public const PAYMENT_TYPE_CASH = 'cash';
    public const PAYMENT_TYPE_INSTALLMENT = 'installment';

    // Payment statuses
    public const STATUS_PENDING = 'pending';
    public const STATUS_ONGOING = 'ongoing';
    public const STATUS_COMPLETED = 'completed';

    /**
     * Relationship: Each payment belongs to a project
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Check if the payment is completed
     */
    public function isCompleted()
    {
        return $this->payment_status === self::STATUS_COMPLETED;
    }

    /**
     * Get remaining balance to be paid
     */
    public function getRemainingBalance()
    {
        return $this->total_price - $this->amount_paid;
    }

    /**
     * Apply a new payment (updates the amount paid)
     */
    public function applyPayment($amount)
    {
        $this->amount_paid += $amount;

        // Update status if fully paid
        if ($this->amount_paid >= $this->total_price) {
            $this->payment_status = self::STATUS_COMPLETED;
        } else {
            $this->payment_status = self::STATUS_ONGOING;
        }

        $this->save();
    }
}
