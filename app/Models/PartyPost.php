<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartyPost extends Model
{
    use HasFactory;

    protected $primaryKey = 'post_id'; // if you used post_id in migration

    protected $fillable = [
        'party_id',
        'title',
        'content',
        'post_type',
        'image_url',
        'video_url',
    ];

    /**
     * Get the party that owns this post.
     */
    public function party()
    {
        return $this->belongsTo(PoliticalParty::class, 'party_id');
    }
}
