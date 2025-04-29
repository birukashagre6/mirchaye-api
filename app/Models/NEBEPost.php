<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NEBEPost extends Model
{
    use HasFactory;

    protected $table = 'nebe_posts';
    protected $fillable = [
        'title',
        'content',
        'category',
        'image_url',
        'video_url',
        'attachment_url',
        'published_at',
    ];
}
