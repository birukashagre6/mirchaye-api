<?php

namespace App\Http\Controllers;

use App\Models\PoliticalParty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PoliticalPartyAuthController extends Controller
{
    public function login(Request $request)
    {
        $party = PoliticalParty::where('party_name', $request->party_name)->first();

        if (! $party || ! Hash::check($request->password, $party->password_hash)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        if (! $party->is_active) {
            return response()->json(['message' => 'Account not active yet.'], 403);
        }

        $token = $party->createToken('party-token')->plainTextToken;
        return response()->json(['token' => $token]);
    }
}

