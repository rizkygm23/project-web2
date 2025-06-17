<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TransaksiController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/kategori/{id}', [HomeController::class, 'category'])->name('category.show');


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/news', function () {
    $posts = Post::latest('published_at')->paginate(5);
    return view('news.index', compact('posts'));
})->name('news.index');

Route::get('/news/{slug}', function ($slug) {
    $post = Post::where('slug', $slug)->with('comments')->firstOrFail();
    return view('news.show', compact('post'));
})->name('news.show');


Route::post('/news/{post}/comment', [CommentController::class, 'store'])->name('comment.store');

Route::get('/dashboard', function () {
    return view('/');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/berita/{slug}', [PostController::class, 'show',])->name('posts.show');

require __DIR__.'/auth.php';

Route::middleware(['auth', 'check.subscription'])->group(function () {
    Route::get('/premium-posts/{slug}', [PostController::class, 'showPremium'])->name('posts.premium');
});

Route::get('/langganan', [SubscriptionController::class, 'showForm'])
     ->name('subscription.form');

Route::get('/transaksi', [TransaksiController::class, 'getToken'])->name('transaksi.token');
// routes/web.php

Route::get('/transaksi/token', [TransaksiController::class, 'getToken'])->name('transaksi.token');
Route::post('/midtrans/callback', [TransaksiController::class, 'handleCallback']);
Route::post('/langganan/activate', [TransaksiController::class, 'activate'])->middleware('auth');
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/berita', [PostController::class, 'index'])->name('berita.index');



