<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Version extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'media_id',
        'version_number',
        'file_url',
    ];

    public function media()
    {
        return $this->belongsTo(Media::class);
    }
}