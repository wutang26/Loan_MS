<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use HasFactory;

     protected $fillable = [
        'performed_by',
        'action',
        'target_type',
        'target_id',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'performed_by');
    }
}
