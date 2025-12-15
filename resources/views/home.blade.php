{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('content')

   {{-- HERO WRAPPER (UNTUK PERLUAS BACKGROUND) --}}
    <div class="mx-auto max-w-[1800px] px-4 md:px-8">

    {{-- HERO (KODE ASLI, TIDAK DIUBAH) --}}
    <section class="relative rounded-3xl overflow-hidden py-24 md:py-32">

        {{-- BACKGROUND IMAGE --}}
        <div
            class="absolute inset-0 bg-cover bg-center"
            style="background-image: url('{{ asset('images/hero-coffe.png') }}');">
        </div>

        {{-- OVERLAY (biar teks kebaca) --}}
        <div class="absolute inset-0 bg-white/70"></div>

        {{-- CONTENT --}}
        <div class="relative z-10 max-w-3xl">
            <p class="uppercase tracking-[0.2em] text-sm text-gray-700">
                Alter Coffe
            </p>

            <h1 class="mt-4 text-4xl md:text-6xl font-semibold leading-tight">
                Modern coffee,<br class="hidden md:block">
                made for your vibe.
            </h1>

            <p class="mt-5 text-lg text-gray-700 leading-relaxed max-w-xl">
                A creamy, clean, and cozy place to sip, chill, and recharge.
            </p>

            <div class="mt-8 flex flex-wrap gap-3">
                <a href="{{ route('menu') }}"
                   class="px-6 py-3 rounded-2xl bg-white shadow hover:opacity-90">
                    Explore Menu
                </a>

                <a href="{{ route('cart') }}"
                   class="px-6 py-3 rounded-2xl bg-[#EFE6D8] shadow hover:opacity-90">
                    View Cart
                </a>
            </div>
        </div>

    </section>
</div>

    
                {{-- FEATURED MENU PREVIEW --}}
                    <section class="mt-10">
                        <div class="flex items-end justify-between gap-4">
                            <div>
                                <h2 class="text-2xl md:text-3xl font-semibold">Featured Menu</h2>
                                <p class="mt-2 text-gray-600">A quick preview of what’s trending today.</p>
                            </div>

                            <a href="{{ route('menu') }}" class="text-sm underline hover:opacity-70">
                                See full menu
                            </a>
                        </div>

                        @php
                            $bestIds = $best->pluck('id')->all();
                        @endphp

                        <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                            @forelse($featured as $p)

                                @php
                                    $isBest = in_array($p->id, $bestIds);
                                    $isNew  = $p->created_at && $p->created_at->gt(now()->subDays(14));
                                @endphp

                                <div class="relative rounded-3xl bg-white border shadow-sm p-5 pt-14">
                                    {{-- BADGE (kiri atas, biar nggak nutup harga) --}}
                                    @if($isBest)
                                        <span class="absolute top-4 left-4 text-xs font-medium px-3 py-1 rounded-full bg-black text-white">
                                            Best Seller
                                        </span>
                                    @elseif($isNew)
                                        <span class="absolute top-4 left-4 text-xs font-medium px-3 py-1 rounded-full bg-[#EFE6D8] text-gray-800">
                                            New
                                        </span>
                                    @endif

                                    {{-- PRICE (kanan atas, rapi & konsisten) --}}
                                    <div class="absolute top-4 right-4 text-right">
                                        <div class="text-[11px] text-gray-500">Price</div>
                                        <div class="font-semibold tabular-nums whitespace-nowrap text-sm md:text-base text-gray-900">
                                            Rp {{ number_format($p->price, 0, ',', '.') }}
                                        </div>
                                    </div>

                                    {{-- CONTENT --}}
                                    <div class="min-w-0">
                                        <div class="text-xs uppercase tracking-[0.2em] text-gray-500">
                                            {{ ucfirst($p->category) }}
                                        </div>

                                        <h3 class="mt-2 text-lg font-semibold truncate">
                                            {{ $p->name }}
                                        </h3>

                                        @if($p->description)
                                            <p class="mt-2 text-sm text-gray-600 line-clamp-2">
                                                {{ $p->description }}
                                            </p>
                                        @endif
                                    </div>

                                    {{-- BUTTON (tetap add to cart beneran) --}}
                                    <form method="POST" action="{{ route('cart.add', $p->id) }}" class="mt-4">
                                        @csrf
                                        <button class="w-full px-4 py-2 rounded-2xl bg-[#EFE6D8] hover:opacity-90">
                                            Add to Cart
                                        </button>
                                    </form>
                                </div>

                            @empty
                                <div class="text-gray-600">
                                    No products yet. Please seed the products first.
                                </div>
                            @endforelse
                        </div>
                    </section>


    {{-- HIGHLIGHTS (CLEAN, VERTICAL, NO CARDS) --}}
<section class="mt-16 max-w-4xl mx-auto text-center">

    {{-- TODAY'S MOOD --}}
    <div class="py-12 reveal">
        <p class="text-xs uppercase tracking-[0.32em] text-gray-500">
            Today’s Mood
        </p>

        <h3 class="mt-4 text-2xl md:text-3xl font-semibold">
            Caramel Latte
        </h3>

        <p class="mt-5 text-gray-700 leading-relaxed text-base md:text-lg mx-auto max-w-2xl">
            Sweet, creamy, and smooth — the safe pick that never misses.
        </p>

        <p class="mt-4 text-sm text-gray-600">
            Best for: <span class="font-medium">morning boost</span>
        </p>
    </div>

    {{-- DIVIDER --}}
    <div class="h-px bg-gray-200/80"></div>

    {{-- FAST ORDER --}}
    <div class="py-12 reveal">
        <p class="text-xs uppercase tracking-[0.32em] text-gray-500">
            Fast Order
        </p>

        <h3 class="mt-4 text-2xl md:text-3xl font-semibold">
            Checkout Ready
        </h3>

        <p class="mt-5 text-gray-700 leading-relaxed text-base md:text-lg mx-auto max-w-2xl">
            Browse first — login only when you’re ready to order.
        </p>

        <p class="mt-4 text-sm text-gray-600">
            Pay with: <span class="font-medium">QRIS • Bank • E-Wallet • Cash</span>
        </p>
    </div>

    {{-- DIVIDER --}}
    <div class="h-px bg-gray-200/80"></div>

    {{-- WHY ALTER COFFE --}}
    <div class="py-12 reveal">
        <p class="text-xs uppercase tracking-[0.32em] text-gray-500">
            Why Alter Coffe?
        </p>

        <h3 class="mt-4 text-2xl md:text-3xl font-semibold">
            Built for your daily reset.
        </h3>

        <div class="mt-8 space-y-10 mx-auto max-w-2xl">
            <div>
                <h4 class="font-semibold text-lg">
                    Clean Taste
                </h4>
                <p class="mt-3 text-gray-700 leading-relaxed">
                    Balanced flavors, no drama — smooth from the first sip to the last.
                </p>
            </div>

            <div>
                <h4 class="font-semibold text-lg">
                    Gen-Z Aesthetic
                </h4>
                <p class="mt-3 text-gray-700 leading-relaxed">
                    Creamy palette, soft vibe — clean visuals that feel calm and modern.
                </p>
            </div>

            <div>
                <h4 class="font-semibold text-lg">
                    Online Order
                </h4>
                <p class="mt-3 text-gray-700 leading-relaxed">
                    Quick checkout, flexible payments — made to be easy.
                </p>
            </div>
        </div>
    </div>

</section>


        

    {{-- OUR STORY + BEST PICKS (NO CARDS) --}}
    <section id="story" class="mt-14">
        <div class="grid md:grid-cols-2 gap-10 items-start">
            {{-- Our Story --}}
            <div>
                <h2 class="text-2xl md:text-3xl font-semibold">Our Story</h2>
                <p class="mt-4 text-gray-700 leading-relaxed">
                    Alter Coffe was born from a simple idea: coffee should feel like a warm reset.
                    Clean flavors, modern vibe, and a menu curated for everyday moments.
                </p>
                <p class="mt-4 text-gray-700 leading-relaxed">
                    Come for the taste, stay for the atmosphere.
                </p>
            </div>

            {{-- Best Picks --}}
            <div>
                <div class="flex items-end justify-between gap-4">
                    <div>
                        <h2 class="text-2xl md:text-3xl font-semibold">Best Picks</h2>
                        <p class="mt-2 text-gray-600">Fresh favorites from the menu.</p>
                    </div>
                    <a href="{{ route('menu') }}" class="text-sm underline hover:opacity-70">
                        View all
                    </a>
                </div>

                <div class="mt-5 space-y-3">
                    @forelse($best as $p)
                        <div class="flex items-center justify-between rounded-2xl bg-white/60 border px-5 py-4">
                            <div>
                                <div class="font-semibold">{{ $p->name }}</div>
                                <div class="text-sm text-gray-600">{{ ucfirst($p->category) }}</div>
                            </div>

                            <div class="flex items-center gap-3">
                                <div class="font-semibold whitespace-nowrap">
                                    Rp {{ number_format($p->price, 0, ',', '.') }}
                                </div>
                                <form method="POST" action="{{ route('cart.add', $p->id) }}">
                                    @csrf
                                    <button class="px-4 py-2 rounded-xl bg-[#EFE6D8] hover:opacity-90">
                                        Add
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="text-gray-600">
                            No products yet. Please seed the products first.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <script>
  (function () {
    const els = document.querySelectorAll('.reveal');
    const io = new IntersectionObserver((entries) => {
      entries.forEach(e => {
        if (e.isIntersecting) {
          e.target.classList.add('reveal-in');
          io.unobserve(e.target);
        }
      });
    }, { threshold: 0.12 });

    els.forEach(el => io.observe(el));
  })();
</script>

<style>
  .reveal { opacity: 0; transform: translateY(14px); transition: opacity .6s ease, transform .6s ease; }
  .reveal-in { opacity: 1; transform: translateY(0); }
</style>


@endsection
