<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EncodingSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'video_codec',
        'audio_codec',
        'resolution',
        'bitrate',
        'framerate',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}