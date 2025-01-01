<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'path',
        'thumbnail_path',
        'formats',
        'status',
        'user_id',
    ];

    protected $casts = [
        'formats' => 'array',
    ];

    protected $appends = [
        'streamable_url',
    ];

    public function getStreamableUrlAttribute()
    {
        return Storage::url($this->formats['hls'] ?? null);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function formats()
    // {
    //     return $this->hasMany(VideoFormat::class);
    // }

}
