<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Channel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category',
        'language',
        'target_audience',
        'branding_assets',
        'metadata',
        'status',
    ];

    protected $casts = [
        'branding_assets' => 'array',
        'metadata' => 'array',
    ];

    public static function boot()
    {
        parent::boot();

    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contents()
    {
        return $this->belongsToMany(Content::class);
    }

    public function schedules()
    {
        return $this->belongsToMany(Schedule::class);
    }

    public function getAnalyticsData()
    {
        // Placeholder for analytics data fetching logic
        return [];
    }
}