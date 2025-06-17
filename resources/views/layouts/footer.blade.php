<footer class="bg-white border-t mt-16">
  <div class="mx-auto max-w-screen-xl px-4 py-12 sm:px-6 lg:px-8">
    <div class="grid grid-cols-2 gap-8 md:grid-cols-4 lg:grid-cols-6">
      <div class="col-span-2">
        <a href="{{ route('home') }}" class="flex items-center space-x-2 text-teal-600">
          <img src="{{ asset('favicon.png') }}" alt="Wawasan+" class="w-10 h-10">
          <span class="text-lg font-bold">Wawasan+</span>
        </a>
        <p class="mt-4 text-sm text-gray-600 leading-relaxed max-w-sm">
          Wawasan+ adalah platform berita dan opini yang menyajikan konten mendalam, terpercaya, dan mudah diakses oleh siapa pun — kapan pun.
        </p>
      </div>

      <div>
        <h3 class="text-sm font-semibold text-gray-900 tracking-wider">Kategori</h3>
        <ul class="mt-4 space-y-2 text-sm text-gray-600">
          @foreach ($categories->take(5) as $category)
            <li>
              <a href="{{ route('category.show', $category->id) }}" class="hover:text-teal-600 transition">
                {{ $category->name }}
              </a>
            </li>
          @endforeach
        </ul>
      </div>

      <div>
        <h3 class="text-sm font-semibold text-gray-900 tracking-wider">Bantuan</h3>
        <ul class="mt-4 space-y-2 text-sm text-gray-600">
          <li><a href="#" class="hover:text-teal-600">FAQ</a></li>
          <li><a href="#" class="hover:text-teal-600">Cara Berlangganan</a></li>
          <li><a href="#" class="hover:text-teal-600">Kontak</a></li>
        </ul>
      </div>

      <div>
        <h3 class="text-sm font-semibold text-gray-900 tracking-wider">Legal</h3>
        <ul class="mt-4 space-y-2 text-sm text-gray-600">
          <li><a href="#" class="hover:text-teal-600">Kebijakan Privasi</a></li>
          <li><a href="#" class="hover:text-teal-600">Syarat & Ketentuan</a></li>
        </ul>
      </div>
    </div>

    <div class="mt-8 flex flex-col sm:flex-row justify-between items-center border-t pt-6 text-sm text-gray-400">
      <p>&copy; {{ now()->year }} Wawasan+. Hak Cipta Dilindungi.</p>
      <div class="flex space-x-4 mt-2 sm:mt-0">
        <a href="#" class="hover:text-teal-600">Facebook</a>
        <a href="#" class="hover:text-teal-600">Instagram</a>
        <a href="#" class="hover:text-teal-600">Twitter</a>
      </div>
    </div>
  </div>
</footer>
