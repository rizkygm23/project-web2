@extends('layouts.app')

@section('content')


<!-- Judul Kategori -->
<div class="max-w-6xl mx-auto px-4 mb-6">
    <h2 class="text-sm font-semibold text-teal-800 bg-teal-200 rounded-full px-6 py-2 w-fit">{{ $selectedCategory->name.' ('.$posts->total().')' }}</h2>
</div>

<!-- Daftar Berita dalam Grid -->
<div class="max-w-6xl mx-auto px-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @foreach ($posts as $post)
        <div class="bg-white rounded-xl shadow hover:shadow-md transition overflow-hidden flex flex-col h-full">
            <img src="{{ $post->getThumbnailUrlAttribute() }}"
                 alt="{{ $post->title }}"
                 class="h-32 w-full object-cover hover:cursor-zoom-in transition-transform duration-300 transform hover:scale-105">

            <div class="p-3 flex flex-col justify-between flex-1">
                <div>
                    <p class="text-xs text-gray-400">
                        {{ $post->category->name ?? 'Uncategorized' }} • {{ $post->created_at->diffForHumans() }}
                    </p>
                    <h4 class="text-xl font-semibold mt-1">{{ Str::limit($post->title, 60) }}</h4>
                </div>
                <a href="{{ route('posts.show', $post->slug) }}"
                   class="mt-4 self-start text-blue-500 text-xs font-normal bg-blue-100 rounded px-3 py-1 hover:bg-blue-200 transition">
                    Read more
                </a>
            </div>
        </div>
    @endforeach
</div>

<!-- Pagination -->
<div class="max-w-6xl mx-auto px-4 mt-8">
    {{ $posts->links() }}
</div>

@endsection
