<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartyApproval extends Model
{
    use HasFactory;

    // Define the table if it doesn't follow the default convention
    protected $table = 'party_approvals'; // Optional, if your table name is not 'party_approvals'

    // Fillable properties for mass assignment
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
        'status',
    ];

    // Define any relationships (if needed)
    public function politicalParty()
    {
        return $this->belongsTo(PoliticalParty::class, 'party_name', 'party_name');
    }
}
