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
            'name' => 'required|string|max:255',
            'comment' => 'required|string|max:1000',
        ]);

        Comment::create($request->only('post_id', 'name', 'comment'));

        return back()->with('success', 'Komentar berhasil dikirim!');
    }
}
