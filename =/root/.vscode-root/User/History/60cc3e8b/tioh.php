<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanRepayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_id',
        'installment_no',
        'due_date',      // required for repayment schedule
        'amount',        // amount of installment
        'status',        // pending/paid
        'amount_paid',   // optional for actual payments
        'payment_date',  // optional
        'payment_method',// optional
        'received_by',   // optional
        'balance_after_payment' // optional
    ];

    /**
     * Repayment belongs to a loan
     */
    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}
