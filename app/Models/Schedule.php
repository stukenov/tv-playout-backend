<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'live_stream_id',
        'scheduled_start',
        'duration',
    ];

    protected $casts = [
        'scheduled_start' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function liveStream()
    {
        return $this->belongsTo(LiveStream::class);
    }
}