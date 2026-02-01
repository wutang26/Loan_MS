<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as SpatiePermission;


class Permission extends SpatiePermission
{
    use HasFactory;

    protected $fillable = [
       'name',
       'module',
       'lable',
       'is_active',
       'description',
       'guard_name',

    ];

    
}
