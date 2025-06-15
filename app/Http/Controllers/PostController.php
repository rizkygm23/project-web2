<?php



namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show($slug)
{
    $post = Post::where('slug', $slug)->firstOrFail();

    $sessionKey = 'post_' . $post->id . '_viewed';

    if (!session()->has($sessionKey)) {
        $post->increment('views');
        session()->put($sessionKey, true);
    }

    return view('posts.show', compact('post'));
}

}

