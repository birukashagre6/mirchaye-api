<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class NEBEAuthController extends Controller
{
    // Login for NEBE Admin
    public function login(Request $request)
    {
        // Validate incoming login request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if the user is NEBE Admin
        $user = User::where('email', $request->email)->where('role', 'nebe')->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials or you are not NEBE admin.'], 401);
        }

        // Generate a token for NEBE admin
        $token = $user->createToken('NEBE-Token')->plainTextToken;

        return response()->json(['token' => $token]);
    }
}
