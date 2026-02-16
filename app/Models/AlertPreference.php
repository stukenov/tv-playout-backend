<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlertPreference extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'threshold',
        'notification_method',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}