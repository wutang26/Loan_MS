<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Rucruit extends Model
{
    use SoftDeletes;


    protected $table = 'rucruit';
    
}
