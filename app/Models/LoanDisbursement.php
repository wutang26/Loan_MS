<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LoanApproval;
use App\Models\Loan;

class LoanDisbursement extends Model
{
    use HasFactory;

       protected $fillable = [
        'loan_approval_id',
        'disbursed_amount',
        'disbursement_date',
        'payment_method',
        'reference_number',
    ];

    /**
     * Disbursement belongs to one LoanApproval
     */
    public function approval()
    {
        return $this->belongsTo(LoanApproval::class);
    }

    /**
     * One Disbursement → One Active Loan
     */
    public function loan()
    {
        return $this->hasOne(Loan::class);
    }
}
