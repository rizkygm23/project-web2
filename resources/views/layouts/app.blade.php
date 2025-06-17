<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" scroll-behavior: smooth;>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <title> Wawasan+</title>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}">

    {{-- <img src="{{ asset('images/logo.png') }}" alt="Wawasan+" class="h-8 w-auto"> --}}
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
    <style>
        html {
            scroll-behavior: smooth;
        }

        @keyframes fade-in {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.2s ease-out;
        }
    </style>



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
<div id="authModal" class="fixed inset-0 bg-gray-100/5 hidden z-50 flex items-center justify-center px-4">
  <div class="bg-white rounded-lg w-full max-w-md p-6 relative shadow-lg">
    <button id="closeAuthModal" class="absolute top-3 right-3 text-gray-500 hover:text-gray-800 text-2xl">&times;</button>

    <div class="flex gap-2 mb-6">
      <button data-tab="login" class="flex-1 text-center py-2 font-medium border-b-2 border-teal-600 text-teal-600 hover:bg-teal-50 rounded-t">Login</button>
      <button data-tab="register" class="flex-1 text-center py-2 font-medium border-b-2 border-transparent text-gray-500 hover:bg-gray-100 rounded-t">Daftar</button>
    </div>

    <!-- Login Tab -->
    <div id="loginTab" class="auth-tab">
      <fieldset class="border border-teal-300 rounded-lg p-4">
        <legend class="text-teal-600 px-2 font-semibold">Login</legend>

        <form method="POST" action="{{ route('login') }}">
          @csrf
          <label class="label">Email</label>
          <input name="email" type="email" placeholder="Email" class="input input-bordered w-full mb-3" required>

          <label class="label">Password</label>
          <input name="password" type="password" placeholder="Password" class="input input-bordered w-full mb-3" required>

          <button type="submit" class="btn bg-teal-600 text-white w-full mt-2 hover:bg-teal-700">Masuk</button>
        </form>
      </fieldset>
    </div>

    <!-- Register Tab -->
    <div id="registerTab" class="auth-tab hidden">
      <fieldset class="border border-teal-300 rounded-lg p-4">
        <legend class="text-teal-600 px-2 font-semibold">Daftar</legend>

        <form method="POST" action="{{ route('register') }}">
          @csrf
          <label class="label">Nama Lengkap</label>
          <input name="name" type="text" placeholder="Nama Lengkap" class="input input-bordered w-full mb-3" required>

          <label class="label">Email</label>
          <input name="email" type="email" placeholder="Email" class="input input-bordered w-full mb-3" required>

          <label class="label">Password</label>
          <input name="password" type="password" placeholder="Password (min. 8 karakter)" class="input input-bordered w-full mb-3" required minlength="8">

          <label class="label">Konfirmasi Password</label>
          <input name="password_confirmation" type="password" placeholder="Konfirmasi Password" class="input input-bordered w-full mb-3" required>

          <button type="submit" class="btn bg-teal-600 text-white w-full mt-2 hover:bg-teal-700">Daftar</button>
        </form>
      </fieldset>
    </div>
  </div>
</div>



        @include('layouts.footer')
    </div>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-KuJQTXqcZiyvlCYw"></script>
    <script>
  const tabs = document.querySelectorAll('[data-tab]');
  const tabContents = {
    login: document.getElementById('loginTab'),
    register: document.getElementById('registerTab'),
  };

  tabs.forEach(btn => {
    btn.addEventListener('click', () => {
      tabs.forEach(b => b.classList.remove('border-teal-600', 'text-teal-600'));
      btn.classList.add('border-teal-600', 'text-teal-600');

      Object.values(tabContents).forEach(c => c.classList.add('hidden'));
      tabContents[btn.dataset.tab].classList.remove('hidden');
    });
  });

  document.getElementById('closeAuthModal').addEventListener('click', () => {
    document.getElementById('authModal').classList.add('hidden');
  });
</script>

    <script>
        function pay() {
            fetch('{{ route('transaksi.token') }}?plan={{ request('plan') }}')
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
                            plan: '{{ request('plan') }}'
                        })
                    });

                    // ✅ Tampilkan popup Midtrans
                    window.snap.pay(data.token, {
                        onSuccess: function(result) {
                            console.log('Pembayaran sukses:', result);
                            window.location.href = '/';
                        },
                        onPending: function(result) {
                            console.log('Menunggu pembayaran:', result);
                            window.location.href = '/';
                        },
                        onError: function(result) {
                            console.log('Gagal bayar:', result);
                            window.location.href = '/';
                        }
                    });
                });
        }
    </script>
</body>

</html>
