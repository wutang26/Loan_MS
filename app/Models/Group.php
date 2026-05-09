<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

     protected $fillable = [
        
     'name', 
     'description',
     'monthly_contribution',
     'penalty_amount'
     ];

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('share_percentage')
            ->withTimestamps();
    }

    public function loans()
    {
        return $this->hasMany(GroupLoan::class);
    }

    //Relation

public function members()
{
    return $this->hasMany(Member::class);
}

//contribution model
public function contributions()
{
    return $this->hasMany(Contribution::class);
}
}
