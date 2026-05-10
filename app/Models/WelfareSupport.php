<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WelfareSupport extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'group_id',         // The group providing support/loan
        'user_id',          // The individual receiving support/loan
        'event_type_id',    // Reason or type of support
        'mode',             // 'support' or 'loan'
        'amount',           // Amount given
        'repayment_amount', // Only used if mode is 'loan'
        'is_repaid',        // Only for loans, default false
        'description',      // Optional description
        'approved_by',      // User ID who approved the support/loan
    ];

    /**
     * Relationships
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function eventType()
    {
        return $this->belongsTo(EventType::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
