<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class PoliticalParty extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'political_parties';

    protected $fillable = [
        'party_name',
        'party_acronym',
        'registration_number',
        'certificate_url',
        'logo_url',
        'president_name',
        'president_photo_url',
        'contact_phone',
        'contact_email',
        'headquarters_address',
        'facebook_url',
        'twitter_url',
        'founded_year',
        'slogan',
        'password_hash',
        'is_active',
        'status'
    ];

    protected $hidden = [
        'password_hash'
    ];
}