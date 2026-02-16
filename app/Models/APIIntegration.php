<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class APIIntegration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'api_key',
        'webhook_url',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}