<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    use HasFactory;

     protected $fillable = [
        'group_id',
        'member_id',
        'contribution_id',
        'amount',
        'type',
        'description',
    ];

    // Relations
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function contribution()
    {
        return $this->belongsTo(Contribution::class);
    }
}
