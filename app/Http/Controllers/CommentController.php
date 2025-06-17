<?php

// app/Http/Controllers/CommentController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'post_id' => 'required|exists:posts,id',
        'comment' => 'required|string|max:1000',
    ]);

    Comment::create([
        'post_id' => $request->post_id,
        'name' => auth()->user()->name, // otomatis ambil dari user login
        'comment' => $request->comment,
    ]);

    return back()->with('success', 'Komentar berhasil ditambahkan.');
}
}
