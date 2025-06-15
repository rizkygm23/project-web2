<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />


    <!-- Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>

<body class="font-sans antialiased">
    <div>
        @include('layouts.navigation')

        {{-- <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif --}}

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
        <!-- Modal Login/Register -->
        <div id="authModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
            <div class="bg-white rounded-lg w-full max-w-md p-6 relative">
                <button id="closeAuthModal"
                    class="absolute top-3 right-3 text-gray-500 hover:text-gray-800">&times;</button>
                <ul class="flex border-b mb-4">
                    <li data-tab="login"
                        class="flex-1 text-center py-2 cursor-pointer hover:border-gray-300 border-b-2 border-transparent">
                        Login</li>
                    <li data-tab="register"
                        class="flex-1 text-center py-2 cursor-pointer hover:border-gray-300 border-b-2 border-transparent">
                        Daftar</li>
                </ul>
                <div id="loginTab" class="auth-tab">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input name="email" type="email" placeholder="Email"
                            class="w-full mb-3 px-3 py-2 border rounded" required>
                        <input name="password" type="password" placeholder="Password"
                            class="w-full mb-3 px-3 py-2 border rounded" required>
                        <button type="submit" class="btn btn-primary w-full">Masuk</button>
                    </form>
                </div>
                <div id="registerTab" class="auth-tab hidden">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <input name="name" type="text" placeholder="Nama Lengkap"
                            class="w-full mb-3 px-3 py-2 border rounded" required>
                        <input name="email" type="email" placeholder="Email"
                            class="w-full mb-3 px-3 py-2 border rounded" required>
                        <input name="password" type="password" placeholder="Password"
                            class="w-full mb-3 px-3 py-2 border rounded" required>
                        <input name="password_confirmation" type="password" placeholder="Konfirmasi Password"
                            class="w-full mb-3 px-3 py-2 border rounded" required>
                        <button type="submit" class="btn btn-secondary w-full">Daftar</button>
                    </form>
                </div>
            </div>
        </div>

        @include('layouts.footer')
    </div>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-KuJQTXqcZiyvlCYw"></script>
    <script>
function pay() {
  fetch('{{ route("transaksi.token") }}?plan={{ request("plan") }}')
    .then(res => res.json())
    .then(data => {
      // ✅ Kirim request update ke server sebelum Snap muncul
      fetch('/langganan/activate', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        body: JSON.stringify({
          plan: '{{ request("plan") }}'
        })
      });

      // ✅ Tampilkan popup Midtrans
      window.snap.pay(data.token, {
        onSuccess: function (result) {
          console.log('Pembayaran sukses:', result);
          window.location.href = '/';
        },
        onPending: function (result) {
          console.log('Menunggu pembayaran:', result);
          window.location.href = '/';
        },
        onError: function (result) {
          console.log('Gagal bayar:', result);
          window.location.href = '/';
        }
      });
    });
}

    </script>
</body>

</html>
