<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LoanApplication;
use App\Models\LoanDisbursement;

class LoanApproval extends Model
{
    use HasFactory;


     protected $fillable = [
        'loan_application_id',
        'approved_amount',
        'approved_by',
        'approval_date',
        'remark',
    ];

    /**
     * LoanApproval belongs to one LoanApplication
     */
    public function loanApplication()
    {
        return $this->belongsTo(LoanApplication::class);
    }

    /**
     * One Approval → One Disbursement
     * Each approved loan has one disbursement
     */
    public function disbursement()
    {
        return $this->hasOne(LoanDisbursement::class);
    }
}
