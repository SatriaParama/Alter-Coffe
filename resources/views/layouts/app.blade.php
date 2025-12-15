<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Alter Coffe</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <style>
        @keyframes cartPop {
          0%   { transform: scale(0.6); opacity: 0.4; }
          60%  { transform: scale(1.25); opacity: 1; }
          100% { transform: scale(1); }
        }
        .cart-pop { animation: cartPop 450ms ease-out; }
        </style>
</head>
<body class="bg-[#FAF7F2] text-gray-900 min-h-screen flex flex-col">
<main class="max-w-6xl mx-auto px-4 pt-24 pb-8 flex-1">

  <nav class="sticky top-0 z-50 bg-white border-b shadow-sm">

    <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
      <a href="{{ route('home') }}" class="font-semibold tracking-wide">Alter Coffe</a>
      <div class="flex gap-4 items-center">
        <a href="{{ route('menu') }}" class="hover:opacity-70">Menu</a>

@php
  $cart = session('cart', []);
  $cartCount = collect($cart)->sum('qty');
  $cartTotal = collect($cart)->sum(fn($i) => ((int)$i['price']) * ((int)$i['qty']));
  $miniItems = collect($cart)->take(3); // ambil 3 item pertama (kalau mau "terakhir", nanti aku kasih opsi)
  $bump = session()->has('cart_bump');
@endphp

@auth
  <a href="{{ route('orders.index') }}" class="hover:opacity-70">My Orders</a>
@endauth


<div class="relative" data-mini-cart>
  {{-- BUTTON: ICON CART --}}
  <button type="button" class="relative inline-flex items-center hover:opacity-70" data-mini-cart-toggle aria-expanded="false">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24"
      fill="none" stroke="currentColor" stroke-width="2"
      stroke-linecap="round" stroke-linejoin="round">
      <circle cx="9" cy="21" r="1"></circle>
      <circle cx="20" cy="21" r="1"></circle>
      <path d="M1 1h4l2.7 13.4a2 2 0 0 0 2 1.6h9.7a2 2 0 0 0 2-1.6L23 6H6"></path>
    </svg>

    @if($cartCount > 0)
      <span class="absolute -top-2 -right-2 min-w-[18px] h-[18px] px-1 rounded-full
                  bg-red-500 text-white text-[11px] font-bold flex items-center justify-center
                  {{ $bump ? 'cart-pop' : '' }}">
        {{ $cartCount }}
      </span>
    @endif
  </button>

  {{-- DROPDOWN --}}
  <div class="hidden absolute right-0 mt-3 w-80 rounded-2xl border bg-white shadow-lg overflow-hidden z-50" data-mini-cart-panel>
    <div class="px-4 py-3 border-b">
      <div class="flex items-center justify-between">
        <div class="font-semibold">Cart</div>
        <div class="text-xs text-gray-500">{{ $cartCount }} item</div>
      </div>
    </div>

    @if($cartCount === 0)
      <div class="px-4 py-6 text-center text-sm text-gray-600">
        Cart kamu masih kosong ☕
      </div>
      <div class="px-4 pb-4">
        <a href="{{ route('menu') }}" class="block text-center px-4 py-2 rounded-xl bg-[#EFE6D8] hover:opacity-80">
          Lihat Menu
        </a>
      </div>
    @else
      <div class="max-h-72 overflow-auto px-4 py-3 space-y-3">
        @foreach($miniItems as $id => $item)
          <div class="flex gap-3 items-center">
            @if(!empty($item['image']))
              <img src="{{ asset('storage/'.$item['image']) }}" class="w-12 h-12 rounded-xl object-cover" alt="">
            @else
              <div class="w-12 h-12 rounded-xl bg-[#EFE6D8]"></div>
            @endif

            <div class="flex-1 min-w-0">
              <div class="text-sm font-semibold truncate">{{ $item['name'] }}</div>
              <div class="text-xs text-gray-600">
                {{ $item['qty'] }}x • Rp {{ number_format($item['price'], 0, ',', '.') }}
              </div>
            </div>

            <div class="text-sm font-semibold">
              Rp {{ number_format(((int)$item['price']) * ((int)$item['qty']), 0, ',', '.') }}
            </div>
          </div>
        @endforeach

        @if(count($cart) > 3)
          <div class="text-xs text-gray-500 pt-1">
            +{{ count($cart) - 3 }} item lainnya…
          </div>
        @endif
      </div>

      <div class="px-4 py-3 border-t">
        <div class="flex items-center justify-between mb-3">
          <div class="text-sm text-gray-600">Total</div>
          <div class="text-base font-bold">Rp {{ number_format($cartTotal, 0, ',', '.') }}</div>
        </div>

        <div class="grid grid-cols-2 gap-2">
          <a href="{{ route('cart') }}" class="text-center px-3 py-2 rounded-xl border hover:bg-gray-50">
            View Cart
          </a>
          <a href="{{ route('checkout') }}" class="text-center px-3 py-2 rounded-xl bg-[#111827] text-white hover:opacity-90">
            Checkout
          </a>
        </div>
      </div>
    @endif
  </div>
</div>




        @auth
          <a href="{{ route('checkout') }}" class="px-3 py-1 rounded bg-[#EFE6D8]">Checkout</a>
          <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit"
          class="px-3 py-1 rounded-2xl border bg-white/70 hover:bg-white transition">
          Logout
          </button>
        </form>

        @else
          <a href="{{ route('login') }}">Login</a>
        @endauth
      </div>
    </div>
  </nav>

  <main class="max-w-6xl mx-auto px-4 py-8">
  @if(session('success')) <div class="mb-4 p-3 rounded bg-green-100">{{ session('success') }}</div> @endif
  @if(session('error')) <div class="mb-4 p-3 rounded bg-red-100">{{ session('error') }}</div> @endif
  @yield('content')
</main>

{{-- FOOTER --}}
<footer class="mt-24 bg-[#EFE6D8]">
    <div class="max-w-6xl mx-auto px-6 py-16">

        {{-- TOP --}}
        <div class="grid md:grid-cols-2 gap-12 items-start">

            {{-- LEFT --}}
            <div class="space-y-6">
                <h3 class="text-xl font-semibold tracking-wide">
                    Alter Coffe
                </h3>

                <p class="text-gray-700 leading-relaxed max-w-md">
                    Modern coffee crafted for everyday moments.
                    Clean taste, cozy vibe, and a space to slow down.
                </p>

                <p class="text-sm text-gray-600">
                    Chat aja <span class="font-medium">081-9031-5040</span><br>
                    WhatsApp chat only
                </p>
            </div>

            {{-- RIGHT --}}
            <div class="space-y-6">
                <h4 class="text-sm uppercase tracking-[0.25em] text-gray-600">
                    Our Location
                </h4>

                <p class="text-gray-700 leading-relaxed text-sm">
                    ALTER Office, Plaza Blok M Lantai 7<br>
                    Jl. Bulungan No.76, RT.6/RW.6<br>
                    Kramat Pela, Kec. Kby. Baru<br>
                    Jakarta Selatan 12130
                </p>
            </div>
        </div>

        {{-- DIVIDER --}}
        <div class="my-10 h-px bg-gray-300/60"></div>

        {{-- BOTTOM --}}
        <div class="text-center space-y-3">
            <p class="text-sm text-gray-600">
                © {{ date('Y') }} Alter Coffe. Build by Satria Ridha Parama.
            </p>

            <p class="text-xs text-gray-500 leading-relaxed max-w-3xl mx-auto">
                Consumer Complaints Service Contact Information<br>
                Directorate General of Consumer Protection and Trade Compliance,
                Ministry of Trade of the Republic of Indonesia<br>
                WhatsApp Direct: 0853-1111-0001
            </p>
        </div>

    </div>
</footer>


</body>
</html>
