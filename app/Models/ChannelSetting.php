<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChannelSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'channel_id',
        'resolution',
        'bitrate',
        'encoding_format',
        'default_schedule_parameters',
    ];

    protected $casts = [
        'default_schedule_parameters' => 'array',
    ];

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
}