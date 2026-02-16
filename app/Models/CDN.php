<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CDN extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'provider',
        'configuration',
        'status',
    ];

    protected $casts = [
        'configuration' => 'json',
        'status' => 'string',
    ];
}