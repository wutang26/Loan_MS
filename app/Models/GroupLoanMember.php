<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupLoanMember extends Model
{
    use HasFactory;
    
     protected $fillable = ['group_loan_id', 'user_id', 'amount'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

//Relation to Mmember 
    public function member(){

         return $this->hasMany(Member::class);
    }
}
