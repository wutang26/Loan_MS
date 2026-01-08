<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Loan;

class LoanRepayment extends Model
{
    use HasFactory;

     protected $fillable = [
        'loan_id',
        'amount_paid',
        'payment_date',
        'payment_method',
        'received_by',
        'balance_after_payment',
     ];
     
     /**
     * Repayment belongs to a loan
     */
    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}
