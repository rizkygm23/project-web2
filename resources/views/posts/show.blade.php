@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto mt-8 px-4">
        <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>
        <p class="text-sm text-gray-500 mb-2">Kategori: {{ $post->category->name ?? 'Tanpa Kategori' }}</p>
        <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-96 object-cover mb-6">

        <div class="prose max-w-none">
            {!! $post->content !!}
        </div>

        <p class="text-sm text-gray-500 mt-6">Penulis: {{ $post->author }}</p>

        <!-- Komentar Section -->
        <div class="max-w-4xl mx-auto mt-12 px-4">
    <h3 class="text-xl font-semibold mb-4 text-teal-600">Komentar</h3>

    @foreach($comments as $comment)
        <div class="bg-white p-4 rounded border-b border-gray-200 mb-3">
            <p class="font-bold">{{ $comment->name }}</p>
            <p class="text-sm text-gray-600">{{ $comment->created_at->diffForHumans() }}</p>
            <p class="mt-2">{{ $comment->comment }}</p>
        </div>
    @endforeach

    @if ($hasMore)
        <div class="text-center mt-4">
            <a href="{{ request()->fullUrlWithQuery(['limit' => $limit + 5]) }}"
               class="inline-block text-teal-600 font-semibold hover:underline">
                Lihat lebih banyak
            </a>
        </div>
    @endif

    {{-- Form Komentar --}}
   @if(auth()->check())
    <form action="{{ route('comments.store') }}" method="POST" class="bg-white p-4 rounded shadow mt-6">
        @csrf
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        {{-- Tidak perlu input nama, pakai dari auth()->user()->name --}}
        <div class="mb-3">
            <label for="comment" class="block text-sm font-medium">Komentar</label>
            <textarea name="comment" rows="4" class="w-full border rounded px-3 py-2" required></textarea>
        </div>
        <button type="submit" class="bg-teal-600 text-white px-4 py-2 rounded hover:bg-teal-700">Kirim</button>
    </form>
@else
    <div class="bg-white p-4 rounded shadow mt-6 text-center">
        <p class="mb-3 text-gray-600">Silakan login untuk memberikan komentar.</p>
        <button onclick="document.getElementById('authModal').classList.remove('hidden')" class="bg-teal-600 text-white px-4 py-2 rounded hover:bg-teal-700">
            Login untuk Komentar
        </button>
    </div>
@endif
</div>


    </div>
@endsection
