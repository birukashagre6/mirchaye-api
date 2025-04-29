<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PartyPost;
use Illuminate\Support\Facades\Auth;

class PartyPostController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();

        

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'post_type' => 'required|in:campaign,news,event,policy',
            'image_url' => 'nullable|url',
            'video_url' => 'nullable|url',
        ]);

        $post = PartyPost::create([
            'party_id' => $user->party_id,
            'title' => $request->title,
            'content' => $request->content,
            'post_type' => $request->post_type,
            'image_url' => $request->image_url,
            'video_url' => $request->video_url,
        ]);

        return response()->json([
            'message' => 'Post created successfully.',
            'post' => $post
        ], 201);
    }
}
