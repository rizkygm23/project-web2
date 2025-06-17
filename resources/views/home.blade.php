@extends('layouts.app')

@section('content')
    <div class="bg-white px-4 py-6">
        <!-- Slider Section -->
        <div class="max-w-6xl mx-auto mt-6">
            <div class="swiper mySwiper h-72 md:h-96 rounded overflow-hidden">
                <div class="swiper-wrapper">
                    @foreach ($sliderPosts as $post)
                        <div class="swiper-slide relative">
                            <img src="{{ $post->getThumbnailUrlAttribute() }}" alt="{{ $post->title }}"
                                class="object-cover w-full h-72 md:h-96" />
                            <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black to-transparent p-4">
                                <h2 class="text-white text-lg md:text-2xl font-bold">
                                    {{ $post->title }}
                                </h2>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- pagination + navigation -->
                <div class="swiper-pagination"></div>
                <button
                    class="custom-prev absolute top-1/2 left-2 transform -translate-y-1/2 z-10 p-2 bg-white rounded-full shadow">
                    <!-- contoh Heroicon chevron-left -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button
                    class="custom-next absolute top-1/2 right-2 transform -translate-y-1/2 z-10 p-2 bg-white rounded-full shadow">
                    <!-- contoh Heroicon chevron-right -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>


        <!-- Latest News -->
        <div class="max-w-6xl mx-auto mt-12">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-teal-600">Berita Terbaru</h3>
                <a href="{{ route('berita.index') }}" class="text-sm text-blue-600 hover:underline">Lihat Semua →</a>

            </div>
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-4 h-fit ">
                @foreach ($latestPosts as $post)
                    <div
                        class="bg-white  skeleton rounded-xl  hover:shadow-md transition overflow-hidden flex  flex-col h-fit md:h-full">
                        <img src="{{ $post->getThumbnailUrlAttribute() }}" alt="{{ $post->title }}"
                            class="h-32 w-full object-cover hover:cursor-zoom-in transition-transform duration-300 transform hover:scale-105">

                        <div class="p-3 flex flex-col h-fit md:justify-between md:h-44">
                            <div>
                                <p class=" text-[10px] md:text-xs text-gray-400">
                                    {{ $post->category->name ?? 'Uncategorized' }} •
                                    {{ $post->created_at->diffForHumans() }}</p>
                                <h4 class=" line-clamp-2 text-sm md:text-xl font-semibold mt-1">{{ Str::limit($post->title, 60) }}</h4>
                            </div>
                            <a href="{{ $post->is_premium && (!auth()->check() || !auth()->user()->isPremium()) ? '#pricing' : route('posts.show', $post->slug) }}"
                                class="text-xs font-normal rounded mt-2 md:mt-0 px-2 py-1 w-fit 
        {{ $post->is_premium && (!auth()->check() || !auth()->user()->isPremium())
            ? 'bg-gray-200 text-gray-400 cursor-not-allowed'
            : 'bg-blue-100 text-blue-500 hover:bg-blue-200' }}">
                                {{ $post->is_premium && (!auth()->check() || !auth()->user()->isPremium()) ? 'Locked' : 'Read more' }}

                            </a>

                        </div>
                    </div>
                @endforeach

            </div>
        </div>

        <!-- Popular Sidebar -->
        <div class="max-w-6xl mx-auto mt-12 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach ($postsAfterSix as $post)
                    <div
                        class="bg-white rounded-xl  hover:shadow-md transition overflow-hidden flex flex-row md:flex-col h-fit">
                        <img src="{{ $post->getThumbnailUrlAttribute() }}" alt="{{ $post->title }}"
                            class=" h-auto md:h-32 w-24 md:w-full object-cover hover:cursor-zoom-in transition-transform duration-300 transform hover:scale-105">

                        <div class="p-3 flex flex-col justify-between h-fit md:h-44">
                            <div>
                                <p class="text-xs text-gray-400">{{ $post->category->name ?? 'Uncategorized' }} •
                                    {{ $post->created_at->diffForHumans() }}</p>
                                <h4 class=" line-clamp-2 text-sm md:text-xl font-semibold mt-1">{{ Str::limit($post->title, 60) }}</h4>
                            </div>
                            <a href="{{ $post->is_premium && (!auth()->check() || !auth()->user()->isPremium()) ? '#pricing' : route('posts.show', $post->slug) }}"
                                class="text-xs font-normal rounded mt-2 md:mt-0 px-2 py-1 w-fit 
        {{ $post->is_premium && (!auth()->check() || !auth()->user()->isPremium())
            ? 'bg-gray-200 text-gray-400 cursor-not-allowed'
            : 'bg-blue-100 text-blue-500 hover:bg-blue-200' }}">
                                {{ $post->is_premium && (!auth()->check() || !auth()->user()->isPremium()) ? 'Locked' : 'Read more' }}

                            </a>


                        </div>
                    </div>
                @endforeach
            </div> <!-- Kosongin space untuk konten lain jika mau -->
            <div class="md:row-span-2">
                <h3 class="text-lg font-semibold mb-4 text-teal-600">Top Posts</h3>
                <ol
                    class="space-y-3 list-decimal list-inside h-fit justify-between text-teal-200 bg-teal-600 p-2 rounded-md ">
                    @foreach ($popularPosts as $post)
                        <li class="bg-teal-50/10 rounded-sm px-4 py-2">
                            <a href="{{ route('posts.show', $post->slug) }}" class="text-xs  hover:underline">
                                {{ Str::limit($post->title, 40) }}
                            </a>
                            <p class="text-[10px] ">{{ $post->created_at->diffForHumans() }}</p>
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>

    <section id="pricing" class="py-12 bg-gray-100 pt-24">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-8 text-teal-600">Pilih Paket Anda</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- Paket Dasar -->
                <div class="card bg-white shadow-sm rounded-xl flex flex-col">
                    <div class="card-body p-6 flex-1 flex flex-col justify-between">
                        @if (auth()->check() && !auth()->user()->isPremium())
                            <span class="badge badge-outline badge-lg">Paket Saat Ini</span>
                        @endif
                        <div class="mt-4">
                            <h2 class="text-2xl font-bold">Dasar</h2>
                            <span class="text-xl text-gray-600">Rp 0/bulan</span>
                        </div>
                        <ul class="mt-6 space-y-3 text-sm">
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-success mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Akses 10 artikel</span>
                            </li>
                            <li class="opacity-50 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-base-content/50 mr-2"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="line-through">Akses tak terbatas</span>
                            </li>
                            <li class="opacity-50 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-base-content/50 mr-2"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="line-through">Tanpa iklan</span>
                            </li>
                            <li class="opacity-50 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-base-content/50 mr-2"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="line-through">Konten eksklusif</span>
                            </li>
                        </ul>
                        <button class="btn btn-disabled mt-6">Saat Ini</button>
                    </div>
                </div>

                <!-- Premium 1 Bulan -->
                <div class="card bg-white shadow-sm rounded-xl flex flex-col">
                    <div class="card-body p-6 flex-1 flex flex-col justify-between">
                        @if (auth()->check() && auth()->user()->isPremium())
                            <span class="badge badge-success badge-lg">Aktif</span>
                            <div class="mt-4">
                                <h2 class="text-2xl font-bold">Premium</h2>
                                <span class="text-xl">Rp 99.000/bulan</span>
                            </div>
                            <ul class="mt-6 space-y-3 text-sm">
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-success mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Akses tak terbatas</span>
                                </li>
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-success mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Tanpa iklan</span>
                                </li>
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-success mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Konten eksklusif</span>
                                </li>
                            </ul>
                            <button class="btn btn-disabled mt-6">Paket Saat Ini</button>
                        @else
                            <div class="mt-4">
                                <h2 class="text-2xl font-bold">Premium</h2>
                                <span class="text-xl">Rp 99.000/bulan</span>
                            </div>
                            <ul class="mt-6 space-y-3 text-sm">
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-success mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Akses tak terbatas</span>
                                </li>
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-success mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Tanpa iklan</span>
                                </li>
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-success mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Konten eksklusif</span>
                                </li>
                            </ul>

                            <button
                                class="btn bg-teal-600 subscribe-btn text-white btn-block mt-6 transition-transform transform group-hover:scale-105 hover:bg-teal-500"
                                data-plan="1">Langganan 1 Bulan</button>
                        @endif
                    </div>
                </div>

                <!-- Premium 6 Bulan -->
                <div class="card bg-white shadow-sm rounded-xl flex flex-col">
                    <div class="card-body p-6 flex-1 flex flex-col justify-between">
                        @if (auth()->check() && auth()->user()->isPremium())
                            <span class="badge badge-success badge-lg">Aktif</span>
                            <div class="mt-4">
                                <h2 class="text-2xl font-bold">Premium</h2>
                                <span class="text-xl">Rp 529.000/6 bulan</span>
                            </div>
                            <ul class="mt-6 space-y-3 text-sm">
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-success mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Semua fitur Premium</span>
                                </li>
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-success mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Dukungan prioritas</span>
                                </li>
                            </ul>
                            <button class="btn btn-disabled mt-6">Paket Saat Ini</button>
                        @else
                            <div class="mt-4">
                                <h2 class="text-2xl font-bold">Premium</h2>
                                <span class="text-xl">Rp 529.000/6 bulan</span>
                            </div>
                            <ul class="mt-6 space-y-3 text-sm">
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-success mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Semua fitur Premium</span>
                                </li>
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-success mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Dukungan prioritas</span>
                                </li>
                            </ul>

                            <button
                                class="btn bg-teal-600 subscribe-btn text-white btn-block mt-6 transition-transform transform group-hover:scale-105 hover:bg-teal-500"
                                data-plan="6">Langganan 6 Bulan</button>
                        @endif
                    </div>
                </div>

                <!-- Premium 12 Bulan -->
                <div class="card bg-white shadow-sm rounded-xl flex flex-col">
                    <div class="card-body p-6 flex-1 flex flex-col justify-between">
                        @if (auth()->check() && auth()->user()->isPremium())
                            <span class="badge badge-success badge-lg">Aktif</span>

                            <div class="mt-4">
                                <h2 class="text-2xl font-bold">Premium</h2>
                                <span class="text-xl">Rp 1.049.000/12 bulan</span>
                            </div>
                            <ul class="mt-6 space-y-3 text-sm">
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-success mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Semua fitur Premium</span>
                                </li>
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-success mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Manajer akun khusus</span>
                                </li>
                            </ul>
                            <button class="btn btn-disabled mt-6">Paket Saat Ini</button>
                        @else
                            <div class="mt-4">
                                <h2 class="text-2xl font-bold">Premium</h2>
                                <span class="text-xl">Rp 1.049.000/12 bulan</span>
                            </div>
                            <ul class="mt-6 space-y-3 text-sm">
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-success mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Semua fitur Premium</span>
                                </li>
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-success mr-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Manajer akun khusus</span>
                                </li>
                            </ul>

                            <button
                                class="btn btn-block subscribe-btn bg-teal-600 text-white mt-6 transform transition-transform duration-300 group-hover:scale-105 hover:bg-teal-500 "
                                data-plan="12">Langganan 12 Bulan</button>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </section>





    {{-- @endsection --}}


    <!-- SwiperJS Init + Premium Modal -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.subscribe-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const isLoggedIn = @json(auth()->check());

                    if (!isLoggedIn) {
                        // Tampilkan modal login/register, jangan redirect
                        document.getElementById('authModal').classList.remove('hidden');
                        switchTab('login');
                        return;
                    }

                    // Sudah login → lanjut ke form langganan
                    const plan = this.dataset.plan;
                    window.location.href = "{{ route('subscription.form') }}" + "?plan=" + plan;
                });
            });

            // Fungsi switch tab
            function switchTab(tab) {
                document.querySelectorAll('.auth-tab').forEach(el => el.classList.add('hidden'));
                document.getElementById(tab + 'Tab').classList.remove('hidden');
                document.querySelectorAll('[data-tab]').forEach(li => {
                    li.classList.toggle('border-b-teal-600', li.dataset.tab === tab);
                });
            }

            // Tab click
            document.querySelectorAll('[data-tab]').forEach(tabBtn => {
                tabBtn.addEventListener('click', () => switchTab(tabBtn.dataset.tab));
            });

            // Close modal
            document.getElementById('closeAuthModal').addEventListener('click', () => {
                document.getElementById('authModal').classList.add('hidden');
            });
            document.getElementById('authModal').addEventListener('click', function(e) {
                if (e.target === this) this.classList.add('hidden');
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            new Swiper('.mySwiper', {
                loop: true,
                autoplay: {
                    delay: 5000
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true
                },
                navigation: {
                    nextEl: '.custom-next',
                    prevEl: '.custom-prev',
                },
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const swiper = new Swiper('.mySwiper', {
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });
        });

        function handlePremiumClick(url) {
            @if (auth()->check() && auth()->user()->isSubscribed())
                window.location.href = url;
            @else
                document.getElementById('premiumModal').classList.remove('hidden');
            @endif
        }

        function closeModal() {
            document.getElementById('premiumModal').classList.add('hidden');
        }
    </script>
@endsection
