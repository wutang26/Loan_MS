<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LoanRepayment;
use App\Models\LoanDisbursement;
use App\Models\Member;
use Spatie\Permission\Traits\HasRoles;

class Loan extends Model
{
    use HasFactory, HasRoles;

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'user_id',
        'loan_disbursement_id',
        'loan_amount',
        'interest_rate',
        'loan_period_months',
        'interest_amount',
        'total_repayment',
        'total_paid',
        'outstanding_loan', 
        'application_date',
        'start_date',
        'end_date',
        'application_status',
    ];

    /**
     * Cast attributes to proper types
     */
    protected $casts = [
        'loan_amount'        => 'decimal:2',
        'interest_rate'      => 'decimal:2',
        'interest_amount'    => 'decimal:2',
        'total_repayment'    => 'decimal:2',
        'total_paid'         => 'decimal:2',
        'outstanding_loan'   => 'decimal:2',
        'start_date'         => 'date',
        'end_date'           => 'date',
    ];

    /* ===============================
     |  RELATIONSHIPS
     |===============================*/

    /**
     * Loan belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Loan belongs to a member (if applicable)
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
        return $this->belongsTo(LoanDisbursement::class, 'loan_disbursement_id');
    }

    /**
     * One Loan → Many Repayments
     */
    public function repayments()
    {
        return $this->hasMany(LoanRepayment::class);
    }

    /* ===============================
     |  SCOPES
     |===============================*/

    public function scopePending($query)
    {
        return $query->where('application_status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('application_status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('application_status', 'rejected');
    }

    public function scopeActive($query)
    {
        return $query->where('application_status', 'approved')
                     ->where('outstanding_loan', '>', 0);
    }

    /* ===============================
     |  HELPERS / BUSINESS LOGIC
     |===============================*/

    public function isPending(): bool
    {
        return $this->application_status === 'pending';
    }

    public function isApproved(): bool
    {
        return $this->application_status === 'approved';
    }

    public function isRejected(): bool
    {
        return $this->application_status === 'rejected';
    }

    /**
     * Check if loan is fully paid
     */
    public function isCleared(): bool
    {
        return $this->outstanding_loan <= 0;
    }

    /**
     * Calculate monthly installment (EMI)
     */
    public function monthlyInstallment(): float
    {
        if ($this->loan_period_months <= 0) {
            return 0;
        }

        return round($this->total_repayment / $this->loan_period_months, 2);
    }

    /**
     * Update outstanding balance after payment
     */
    public function applyPayment(float $amount): void
    {
        $this->total_paid += $amount;
        $this->outstanding_loan -= $amount;

        if ($this->outstanding_loan < 0) {
            $this->outstanding_loan = 0;
        }

        $this->save();
    }
}