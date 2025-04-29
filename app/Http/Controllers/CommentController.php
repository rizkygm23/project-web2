<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'comment' => 'required|string',
        ]);

        $post->comments()->create([
            'name' => $request->name,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Komentar berhasil dikirim!');
    }
}
