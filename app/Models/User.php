<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use  HasFactory, Notifiable, HasRoles;

    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'usertype',
        'status',
    ];


    //Roles handling
     public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isStaff()
    {
        return $this->role === 'staff';
    }

    public function isLoanOfficer()
    {
        return $this->role === 'loan_officer';
    }

//Roles and Permission for auth users

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //User Relation
    public function user()
{
    return $this->belongsTo(User::class);
}

public function loans()
{
    return $this->hasMany(Loan::class);
}


/**
 * Check if user has a loan with outstanding balance
 */
public function hasActiveLoan()
{
    return $this->loans()
        ->where('outstanding_loan', '>', 0)
        ->exists();
}

   //User has Approved Loan
    public function hasApprovedLoan()
{
    return $this->loans()
        ->where('application_status', 'approved')
        ->exists();
}

}
