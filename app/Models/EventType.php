<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
    use HasFactory;

     protected $fillable = [
        'burrial_celemon',
        'child_birth',
        'wedding',
        'sickness',
        'accident',
        'school_support',
    ];

    //Event
    public function event_types()
    {
        return $this->belongsTo(EventType::class);
    }
}
