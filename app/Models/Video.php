<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
