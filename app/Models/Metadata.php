<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Metadata extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'media_id',
        'title',
        'description',
        'genre',
        'language',
        'tags',
        'custom_fields',
    ];

    protected $casts = [
        'tags' => 'array',
        'custom_fields' => 'array',
    ];

    public function media()
    {
        return $this->belongsTo(Media::class);
    }
}