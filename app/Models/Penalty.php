<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penalty extends Model
{
    use HasFactory;

     protected $fillable = [

        'member_id',
        'group_id',
        'contribution_id',
        'amount',
        'reason',
        'status'
    ];

    //Relation to member

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    //Relate to group
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    //Relate to Contribution
    public function contribution()
    {
        return $this->belongsTo(Contribution::class);
    }
}
