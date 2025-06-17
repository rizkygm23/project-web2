@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold text-teal-600 mb-8 text-center">Semua Berita</h1>

    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($posts as $post)
            <div
                        class="bg-white  skeleton rounded-xl  hover:shadow-md transition overflow-hidden flex  flex-col h-fit md:h-full">
                        <img src="{{ $post->getThumbnailUrlAttribute() }}" alt="{{ $post->title }}"
                            class="h-32 w-full object-cover hover:cursor-zoom-in transition-transform duration-300 transform hover:scale-105">

                        <div class="p-3 flex flex-col h-fit md:justify-between md:h-44">
                            <div>
                                <p class=" text-[10px] md:text-xs text-gray-400">
                                    {{ $post->category->name ?? 'Uncategorized' }} •
                                    {{ $post->created_at->diffForHumans() }}</p>
                                <h4 class=" line-clamp-2 text-xs md:text-xl font-semibold mt-1">{{ Str::limit($post->title, 60) }}</h4>
                            </div>
                            <a href="{{ $post->is_premium && (!auth()->check() || !auth()->user()->isPremium()) ? '#pricing' : route('posts.show', $post->slug) }}"
                                class="text-xs font-normal rounded px-2 mt-2 md:mt-0 py-1 w-fit 
        {{ $post->is_premium && (!auth()->check() || !auth()->user()->isPremium())
            ? 'bg-gray-200 text-gray-400 cursor-not-allowed'
            : 'bg-blue-100 text-blue-500 hover:bg-blue-200' }}">
                                {{ $post->is_premium && (!auth()->check() || !auth()->user()->isPremium()) ? 'Locked' : 'Read more' }}

                            </a>

                        </div>
                    </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $posts->links() }}
    </div>
</div>
@endsection
