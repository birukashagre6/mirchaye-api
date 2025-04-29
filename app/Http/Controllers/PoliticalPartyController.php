<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\PoliticalParty;

class PoliticalPartyController extends Controller
{
    // Show authenticated party profile
    public function show(Request $request)
    {
        return response()->json($request->user());
    }

    // Update authenticated party profile
    public function update(Request $request)
    {
        $party = $request->user();

        $validator = Validator::make($request->all(), [
            'party_name' => 'string|max:255',
            'party_acronym' => 'string|max:50',
            'registration_number' => 'string|max:100',
            'certificate_url' => 'url|nullable',
            'logo_url' => 'url|nullable',
            'president_name' => 'string|max:255',
            'president_photo_url' => 'url|nullable',
            'contact_phone' => 'string|max:20',
            'contact_email' => 'email|max:255',
            'headquarters_address' => 'string|max:255',
            'facebook_url' => 'url|nullable',
            'twitter_url' => 'url|nullable',
            'founded_year' => 'integer|nullable',
            'slogan' => 'string|nullable|max:255',
            'password' => 'string|min:6|confirmed',
            'is_active' => 'boolean',
            'status' => 'string|max:100'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = $validator->validated();

        if (isset($data['password'])) {
            $data['password_hash'] = Hash::make($data['password']);
            unset($data['password']);
        }

        $party->update($data);

        return response()->json(['message' => 'Profile updated successfully', 'party' => $party]);
    }
}
