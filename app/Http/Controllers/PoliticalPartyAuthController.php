<?php

namespace App\Http\Controllers;

use App\Models\PoliticalParty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

use Illuminate\Validation\ValidationException;

class PoliticalPartyAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'party_name' => 'required|string',
            'password' => 'required|string',
        ]);
    
        $party = PoliticalParty::where('party_name', $request->party_name)
                ->orWhere('contact_email', $request->party_name)
                ->first();
    
        if (!$party) {
            return response()->json(['message' => 'Party not found'], 404);
        }
    
        if (!Hash::check($request->password, $party->password_hash)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    
        if (!$party->is_active) {
            return response()->json(['message' => 'Account not active'], 403);
        }
    
        if ($party->status !== 'approved') {
            return response()->json(['message' => 'Account pending approval'], 403);
        }
    
        // Verify the party has an ID
      
    
        // Create token with explicit guard
        $token = $party->createToken(
            'party-auth', 
            ['*'],
            now()->addDays(30)
        )->plainTextToken;
    
        return response()->json([
            'token' => $token,
            'party' => $party->only(['id', 'party_name', 'party_acronym'])
        ]);
    }
}