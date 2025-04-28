<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class NEBEAdminSeeder extends Seeder
{
    public function run()
    {
        // Check if the NEBE Admin already exists
        if (!User::where('email', 'admin@nebe.et')->exists()) {
            User::create([
                'name' => 'NEBE Admin',
                'email' => 'admin@nebe.et',
                'password' => Hash::make('password123'), // secure password
                'role' => 'nebe',
                'party_id' => null, // not linked to any party
            ]);
        }
    }
}
