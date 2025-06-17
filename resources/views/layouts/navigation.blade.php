<header class="bg-white sticky top-0 z-50">
    <div class="mx-auto flex h-16 max-w-screen-xl items-center gap-8 px-4 sm:px-6 lg:px-8">
        <!-- Logo -->
        <a class="block text-teal-600" href="{{ route('home') }}">
            <img src="{{ asset('favicon.png') }}" alt="Wawasan+" class="h-8 w-auto">
        </a>

        <div class="flex flex-1 items-center justify-end md:justify-between">
            <!-- Kategori (desktop & toggleable mobile) -->
            <div id="mobileMenu" class="hidden md:block absolute top-16 left-0 w-full bg-white md:static md:w-auto md:bg-transparent z-40 border-t md:border-none shadow md:shadow-none">
                <nav aria-label="Global" class="px-4 py-4 md:px-0 md:py-0">
                    <ul class="flex flex-col md:flex-row md:space-x-4 space-y-2 md:space-y-0">
                        @foreach ($categories as $category)
                            @php
                                $currentCategoryId = request()->routeIs('category.show') ? request()->route('id') : null;
                                $isActive = $currentCategoryId == $category->id;
                            @endphp
                            <li>
                                <a href="{{ $isActive ? route('home') : route('category.show', $category->id) }}"
                                    class="relative inline-block px-1 py-1 text-sm font-medium transition duration-200
                                        {{ $isActive ? 'text-teal-600' : 'text-gray-700 hover:text-teal-600' }}
                                        after:absolute after:left-0 after:bottom-0 after:h-[2px] after:w-full after:bg-teal-600
                                        after:origin-left after:scale-x-0 after:transition-transform after:duration-200
                                        hover:after:scale-x-100
                                        {{ $isActive ? 'after:scale-x-100' : '' }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </nav>
            </div>

            <!-- Auth -->
            <div class="flex items-center gap-4">
                @guest
                    <div class="sm:flex sm:gap-4">
                        <button
                            class="block rounded-md bg-teal-600 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-teal-700"
                            onclick="document.getElementById('authModal').classList.remove('hidden')">
                            Login
                        </button>

                        <button
                            class="hidden sm:block rounded-md bg-gray-100 px-5 py-2.5 text-sm font-medium text-teal-600 transition hover:text-teal-600/75"
                            onclick="document.getElementById('authModal').classList.remove('hidden')">
                            Register
                        </button>
                    </div>
                @else
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="rounded-md px-5 py-2.5 text-sm font-medium text-slate-600 hover:text-slate-600/75 transition">
                            Keluar
                        </button>
                    </form>
                @endguest

                <!-- Mobile Toggle -->
                <button
                    class="block rounded-sm bg-gray-100 p-2.5 text-gray-600 transition hover:text-gray-600/75 md:hidden"
                    onclick="document.getElementById('mobileMenu').classList.toggle('hidden')">
                    <span class="sr-only">Toggle menu</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</header>
