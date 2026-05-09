<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    use HasFactory;

     protected $fillable = [
        'group_id',
        'member_id',
        'amount',
        'month',
        'year',
        'paid_at',
        'status',
    ];

    //Relation
    public function group()
{
    return $this->belongsTo(Group::class);
}

public function member()
{
    return $this->belongsTo(Member::class);
}

//Contribution
public function penalties()
{
    return $this->hasMany(Penalty::class);
}
}
