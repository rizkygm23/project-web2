<?php



namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{


public function show($slug, Request $request)
{
    $post = Post::where('slug', $slug)->firstOrFail();

    // Tambah view count hanya sekali per session
    $sessionKey = 'post_' . $post->id . '_viewed';
    if (!session()->has($sessionKey)) {
        $post->increment('views');
        session()->put($sessionKey, true);
    }

    // Komentar: ambil limit dari query string (?limit=5), default 5
    $limit = $request->query('limit', 5);

    // Ambil komentar terbaru terbatas
    $comments = $post->comments()->latest()->take($limit)->get();

    // Cek apakah ada komentar lebih dari limit
    $hasMore = $post->comments()->count() > $limit;

    return view('posts.show', compact('post', 'comments', 'hasMore', 'limit'));
}

}

