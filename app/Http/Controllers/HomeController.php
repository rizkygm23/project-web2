<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Semua kategori untuk navbar
        $categories = Category::all();

        // Slider: ambil 5 berita acak
        $sliderPosts = Post::inRandomOrder()->take(5)->get();

        $alLPosts = Post::all();
        // List semua berita terbaru (misalnya 20)
        $latestPosts = Post::latest()->paginate(8);

        // Berita terpopuler (berdasarkan views)
        $popularPosts = Post::orderByDesc('views')->take(8)->get();

        $premiumPosts = Post::where('is_premium', true)->latest()->take(2)->get();
        $postsAfterSix = Post::latest()
            ->skip(8)           // lewati 6 item pertama
            ->take(6)          // ambil 20 berikutnya (atau pakai paginate())
            ->get();


        return view('home', compact('categories', 'sliderPosts', 'latestPosts', 'popularPosts', 'premiumPosts', 'postsAfterSix'));
    }

    public function category($id)
    {
        $categories = Category::all();
        $selectedCategory = Category::findOrFail($id);

        $posts = Post::where('category_id', $id)->latest()->paginate(20);

        return view('category', compact('categories', 'selectedCategory', 'posts',));
    }
}
