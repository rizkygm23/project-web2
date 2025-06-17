@extends('layouts.app')

@section('content')


<!-- Judul Kategori -->
<div class="max-w-6xl mx-auto px-4 mb-6">
    <h2 class="text-sm font-semibold text-teal-800 bg-teal-200 rounded-full px-6 py-2 w-fit">{{ $selectedCategory->name.' ('.$posts->total().')' }}</h2>
</div>

<!-- Daftar Berita dalam Grid -->
<div class="max-w-6xl mx-auto px-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @foreach ($posts as $post)
<div
                        class="bg-white skeleton rounded-xl shadow hover:shadow-md transition overflow-hidden flex flex-col h-full">
                        <img src="{{ $post->getThumbnailUrlAttribute() }}" alt="{{ $post->title }}"
                            class="h-32 w-full object-cover hover:cursor-zoom-in transition-transform duration-300 transform hover:scale-105">

                        <div class="p-3 flex flex-col justify-between h-44">
                            <div>
                                <p class="text-xs text-gray-400">{{ $post->category->name ?? 'Uncategorized' }} •
                                    {{ $post->created_at->diffForHumans() }}</p>
                                <h4 class="text-xl font-semibold mt-1">{{ Str::limit($post->title, 50) }}</h4>
                            </div>
                            <a href="{{ $post->is_premium && (!auth()->check() || !auth()->user()->isPremium()) ? '/#pricing' : route('posts.show', $post->slug) }}"
                                class="text-xs font-normal rounded px-2 py-1 w-fit 
        {{ $post->is_premium && (!auth()->check() || !auth()->user()->isPremium())
            ? 'bg-gray-200 text-gray-400 cursor-not-allowed'
            : 'bg-blue-100 text-blue-500 hover:bg-blue-200' }}">
                                {{ $post->is_premium && (!auth()->check() || !auth()->user()->isPremium()) ? 'Locked' : 'Read more' }}

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
