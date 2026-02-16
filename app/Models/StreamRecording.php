<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StreamRecording extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'live_stream_id',
        'status',
        'added_to_vod',
        'content_id',
        'duration',
    ];

    protected $casts = [
        'added_to_vod' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function liveStream()
    {
        return $this->belongsTo(LiveStream::class);
    }

    public function content()
    {
        return $this->belongsTo(Content::class);
    }
}