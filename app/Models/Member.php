<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\District;
use App\Models\Region;
use App\Models\LoanApplication;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_number',
        'first_name',
        'middle_name',
        'last_name',
        'phone',
        'address',
        'region_id',
        'district_id',
        'date_joined',
        'status',
    ];


    /**
     * One Member → Many Loan Applications
     * A member can apply for multiple loans
     */
    public function loanApplications()
    {
        return $this->hasMany(LoanApplication::class);
    }

    /**
     * Member belongs to a region
     */
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Member belongs to a district
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
