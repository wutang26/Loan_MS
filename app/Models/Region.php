<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];


     /**
     * Region (1) ──── (Many) Districts
     * A region can have many districts
     */
    public function districts()
    {
        return $this->hasMany(District::class);
    }

    /**
     * Region can have many members
     */
    public function members()
    {
        return $this->hasMany(Member::class);
    }
}
