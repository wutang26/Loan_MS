<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Member;
use App\Models\LoanApproval;

class LoanApplication extends Model
{
    use HasFactory;

     protected $fillable = [
        'member_id',
        'requested_amount',
        'interest_rate',
        'loan_period_months',
        'purpose',
        'application_date',
        'application_status',
        'application_status',
    ];


      /**
     * One Loan Application belongs to one Member
     */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    /**
     * One Loan Application → One Approval
     * Each loan application has one approval record
     */
    public function approval()
    {
        return $this->hasOne(LoanApproval::class);
    }
}
