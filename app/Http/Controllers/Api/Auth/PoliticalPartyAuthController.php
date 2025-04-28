<?php

// app/Http/Controllers/Api/Auth/PoliticalPartyAuthController.php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\PoliticalParty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class PoliticalPartyAuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'party_name' => 'required|string|max:100|unique:political_parties',
            'password' => 'required|string|min:8',
            'party_acronym' => 'required|string|max:20|unique:political_parties',
            'registration_number' => 'required|string|max:50|unique:political_parties',
            'contact_phone' => 'required|string|max:20',
            'contact_email' => 'required|email|max:100|unique:political_parties',
            'headquarters_address' => 'required|string',
            'president_name' => 'required|string|max:100',
            'founded_year' => 'required|integer',
        ]);

        $party = PoliticalParty::create([
            'party_name' => $validated['party_name'],
            'password_hash' => Hash::make($validated['password']),
            'party_acronym' => $validated['party_acronym'],
            'registration_number' => $validated['registration_number'],
            'contact_phone' => $validated['contact_phone'],
            'contact_email' => $validated['contact_email'],
            'headquarters_address' => $validated['headquarters_address'],
            'president_name' => $validated['president_name'],
            'founded_year' => $validated['founded_year'],
            'is_active' => true,
        ]);

        return response()->json([
            'party' => $party,
            'token' => $party->createToken('party_token')->plainTextToken
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'party_name' => 'required|string',
            'password' => 'required|string',
        ]);

        $party = PoliticalParty::where('party_name', $request->party_name)->first();

        if (!$party || !Hash::check($request->password, $party->password_hash)) {
            throw ValidationException::withMessages([
                'party_name' => ['The provided credentials are incorrect.'],
            ]);
        }

        return response()->json([
            'token' => $party->createToken('party_token')->plainTextToken
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function me(Request $request)
    {
        return response()->json($request->user());
    }
}