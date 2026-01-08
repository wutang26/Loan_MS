<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LoanRepayment;
use App\Models\LoanDisbursement;
use App\Models\Member;

class Loan extends Model
{
    use HasFactory;

     protected $fillable = [
        'member_id',
        'loan_disbursement_id',
        'loan_amount',
        'interest_rate',
        'loan_period_months',
        'interest_amount',
        'total_repayment',
        'total_paid',
        'out_standing_loan',
        'start_date',
        'end_date',
        'application_status',
    ];



    /**
     * Loan belongs to a member
     */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    /**
     * Loan belongs to a disbursement
     */
    public function disbursement()
    {
        return $this->belongsTo(LoanDisbursement::class);
    }

    /**
     * One Loan → Many Repayments
     * A loan can have multiple repayments
     */
    public function repayments()
    {
        return $this->hasMany(LoanRepayment::class);
    }
}
