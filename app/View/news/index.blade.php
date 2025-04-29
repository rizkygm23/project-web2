@extends('layouts.app') <!-- Kalau pakai layout -->

@section('content')
    <h1>Semua Berita</h1>

    @foreach ($posts as $post)
        <div class="mb-6">
            <img src="{{ Storage::url($post->thumbnail) }}" alt="Thumbnail" class="w-full h-64 object-cover rounded">
            <h2 class="text-2xl font-bold mt-2">{{ $post->title }}</h2>
            <p>{{ Str::limit(strip_tags($post->content), 150) }}</p>
            <a href="{{ route('news.show', $post->slug) }}" class="text-blue-500">Baca Selengkapnya</a>
        </div>
    @endforeach

    {{ $posts->links() }}
@endsection
