<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'criteria',
        'frequency',
    ];
}