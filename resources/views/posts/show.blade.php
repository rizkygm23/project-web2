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
    </div>
@endsection
