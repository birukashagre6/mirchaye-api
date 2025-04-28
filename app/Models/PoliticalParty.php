<?php

// app/Models/PoliticalParty.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class PoliticalParty extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $primaryKey = 'party_id';
    public $incrementing = true;

    protected $fillable = [
        'party_name',
        'password_hash',
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
        'is_active'
    ];

    protected $hidden = [
        'password_hash',
    ];

    public function getAuthPassword()
    {
        return $this->password_hash;
    }
}
