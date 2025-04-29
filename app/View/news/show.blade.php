@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <img src="{{ Storage::url($post->thumbnail) }}" alt="Thumbnail" class="w-full h-96 object-cover rounded">
    </div>

    <h1 class="text-4xl font-bold mb-4">{{ $post->title }}</h1>

    <div class="prose max-w-none">
        {!! $post->content !!}
    </div>

    <hr class="my-8">

    <h2 class="text-2xl font-semibold mb-4">Komentar</h2>

    @foreach ($post->comments as $comment)
        <div class="mb-4">
            <strong>{{ $comment->name }}</strong>
            <p>{{ $comment->comment }}</p>
        </div>
    @endforeach

    <form action="{{ route('comment.store', $post) }}" method="POST" class="mt-6">
        @csrf
        <input type="text" name="name" placeholder="Nama Anda" required class="border p-2 w-full mb-2">
        <textarea name="comment" placeholder="Tulis komentar..." required class="border p-2 w-full mb-2"></textarea>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Kirim Komentar</button>
    </form>
@endsection
