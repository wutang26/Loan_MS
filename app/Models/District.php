<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Region;
use App\Models\Member;

class District extends Model
{
    use HasFactory;
    
     protected $fillable = [
        'region_id',
        'name',
    ];


     /**
     * Each district belongs to one region
     */
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * District can have many members
     */
    public function members()
    {
        return $this->hasMany(Member::class);
    }
}
