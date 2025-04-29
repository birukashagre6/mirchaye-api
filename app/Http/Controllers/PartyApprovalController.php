<?php
namespace App\Http\Controllers;

use App\Models\PartyApproval;
use App\Models\PoliticalParty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PartyApprovalController extends Controller
{
    public function registerRequest(Request $request)
    {
        $data = $request->validate([
            'party_name' => 'required|unique:party_approvals',
            'party_acronym' => 'required|unique:party_approvals',
            'registration_number' => 'required|unique:party_approvals',
            'president_name' => 'required',
            'contact_phone' => 'required',
            'contact_email' => 'required|email',
            'headquarters_address' => 'required',
            'founded_year' => 'required|integer',
            'password' => 'required|min:8',
        ]);

        $data['password_hash'] = bcrypt($request->password);
        $party = PartyApproval::create($data);

        return response()->json(['message' => 'Registration request submitted. Awaiting approval.'], 201);
    }

    public function listPending()
    {
        $requests = PartyApproval::where('status', 'pending')->get();
        return response()->json($requests);
    }

    public function approve($id)
    {
        $approval = PartyApproval::findOrFail($id);

        // Create official Political Party account
        PoliticalParty::create([
            'party_name' => $approval->party_name,
            'party_acronym' => $approval->party_acronym,
            'registration_number' => $approval->registration_number,
            'certificate_url' => $approval->certificate_url,
            'logo_url' => $approval->logo_url,
            'president_name' => $approval->president_name,
            'president_photo_url' => $approval->president_photo_url,
            'contact_phone' => $approval->contact_phone,
            'contact_email' => $approval->contact_email,
            'headquarters_address' => $approval->headquarters_address,
            'facebook_url' => $approval->facebook_url,
            'twitter_url' => $approval->twitter_url,
            'founded_year' => $approval->founded_year,
            'slogan' => $approval->slogan,
            'password_hash' => $approval->password_hash,
            'is_active' => true,
            'status'=> 'approved',
        ]);

     
        $approval->save();

        return response()->json(['message' => 'Party approved successfully.']);
    }

    public function reject($id)
    {
        $approval = PartyApproval::findOrFail($id);
        $approval->status = 'rejected';
        $approval->save();

        return response()->json(['message' => 'Party request rejected.']);
    }
}

