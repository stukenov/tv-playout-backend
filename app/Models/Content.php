<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'type',
        'source',
        'source_id',
        'duration',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function streamRecording()
    {
        return $this->hasOne(StreamRecording::class);
    }

    // ... other relationships and methods ...
}