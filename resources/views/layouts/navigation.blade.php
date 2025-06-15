<header class="bg-white sticky top-0 z-50">
  <div class="mx-auto flex h-16 max-w-screen-xl items-center gap-8 px-4 sm:px-6 lg:px-8">
    <!-- Logo -->
    <a class="block text-teal-600" href="{{ route('home') }}">
      <span class="sr-only">Home</span>
      <svg class="h-8" viewBox="0 0 28 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <!-- your logo path here -->
      </svg>
    </a>

    <div class="flex flex-1 items-center justify-end md:justify-between">
      <!-- Kategori -->
      <nav aria-label="Global" class="hidden md:block">
        <ul class="flex space-x-4">
          @foreach ($categories as $category)
            <li>
              <a href="{{ route('category.show', $category->id) }}" class="hover:text-blue-500">
                {{ $category->name }}
              </a>
            </li>
          @endforeach
        </ul>
      </nav>

      <!-- Auth -->
      <div class="flex items-center gap-4">
        @guest
          <div class="sm:flex sm:gap-4">
            <button
              class="block rounded-md bg-teal-600 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-teal-700"
              onclick="document.getElementById('authModal').classList.remove('hidden')"
            >
              Login
            </button>

            <button
              class="hidden sm:block rounded-md bg-gray-100 px-5 py-2.5 text-sm font-medium text-teal-600 transition hover:text-teal-600/75"
              onclick="document.getElementById('authModal').classList.remove('hidden')"
            >
              Register
            </button>
          </div>
        @else
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button
              type="submit"
              class="rounded-md  px-5 py-2.5 text-sm font-medium text-slate-600 transition "
            >
              Keluar
            </button>
          </form>
        @endguest

        <!-- Mobile Toggle -->
        <button
          class="block rounded-sm bg-gray-100 p-2.5 text-gray-600 transition hover:text-gray-600/75 md:hidden"
        >
          <span class="sr-only">Toggle menu</span>
          <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>
    </div>
  </div>
</header>
