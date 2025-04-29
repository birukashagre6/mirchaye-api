<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NEBEPost;
use Illuminate\Support\Facades\Auth;

class NEBEPostController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'nebe') {
            return response()->json(['message' => 'Only NEBE admins can post.'], 403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|in:announcement,press_release,guideline,timeline',
            'image_url' => 'nullable|url',
            'video_url' => 'nullable|url',
            'attachment_url' => 'nullable|url',
            'published_at' => 'nullable|date',
        ]);

        $post = NEBEPost::create($request->only([
            'title',
            'content',
            'category',
            'image_url',
            'video_url',
            'attachment_url',
            'published_at',
        ]));

        return response()->json([
            'message' => 'NEBE announcement posted successfully.',
            'post' => $post
        ], 201);
    }
}
