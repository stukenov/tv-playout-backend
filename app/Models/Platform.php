<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'api_endpoint',
        'credentials',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];
}