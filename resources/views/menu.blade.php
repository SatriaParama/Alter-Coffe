@extends('layouts.app')

@section('content')
    <div class="flex items-end justify-between gap-4">
        <div>
            <h1 class="text-3xl font-semibold">Menu</h1>
            <p class="mt-1 text-gray-600">Pick your mood. Add to cart. Checkout when ready.</p>
        </div>
        <a href="{{ route('cart') }}" class="px-4 py-2 rounded-2xl bg-white shadow hover:opacity-90">
            View Cart
        </a>
    </div>

    {{-- Categories (simple) --}}
    @php
        $grouped = $products->groupBy('category');
        $catLabel = [
            'coffee' => 'Coffee',
            'non-coffee' => 'Non-Coffee',
            'tea' => 'Tea',
            'pastry' => 'Pastry',
        ];
    @endphp

    <div class="mt-8 space-y-10">
        @foreach($grouped as $cat => $items)
            <section>
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold">{{ $catLabel[$cat] ?? ucfirst($cat) }}</h2>
                    <span class="text-sm text-gray-600">{{ $items->count() }} items</span>
                </div>

                <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach($items as $p)
                        <div class="rounded-3xl bg-white shadow-sm border overflow-hidden">
                            <div class="h-40 bg-[#FAF7F2] overflow-hidden">
                                @if(!empty($p->image))
                                    <img
                                        src="{{ asset($p->image) }}"
                                        alt="{{ $p->name }}"
                                        class="w-full h-full object-cover"
                                    >
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-sm text-gray-500">
                                        No image
                                    </div>
                                @endif
                            </div>

                            <div class="p-5">
                                <div class="flex items-start justify-between gap-3">
                                    <div>
                                        <h3 class="font-semibold text-lg">{{ $p->name }}</h3>
                                        @if($p->description)
                                            <p class="mt-1 text-sm text-gray-600 line-clamp-2">{{ $p->description }}</p>
                                        @endif
                                    </div>
                                    <div class="font-semibold whitespace-nowrap">
                                        Rp {{ number_format($p->price, 0, ',', '.') }}
                                    </div>
                                </div>

                                <form method="POST" action="{{ route('cart.add', $p->id) }}" class="mt-4">
                                    @csrf
                                    <button class="w-full px-4 py-2 rounded-2xl bg-[#EFE6D8] hover:opacity-90">
                                        Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endforeach
    </div>

    {{-- Promo Popup (shown only once per session) --}}
    @if($popup && !$promoSeen)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div class="absolute inset-0 bg-black/40"></div>

            <div class="relative w-full max-w-md rounded-3xl bg-white shadow-xl overflow-hidden">
                <div class="p-6">
                    <p class="text-sm uppercase tracking-[0.2em] text-gray-600">{{ $popup->title ?? 'Special Offer' }}</p>
                    <h3 class="mt-2 text-2xl font-semibold">{{ $popup->product->name }}</h3>
                    <p class="mt-1 text-gray-600">
                        Rp {{ number_format($popup->product->price, 0, ',', '.') }}
                    </p>

                    <div class="mt-5 flex gap-3">
                        <form method="POST" action="{{ route('cart.add', $popup->product->id) }}" class="flex-1">
                            @csrf
                            <button class="w-full px-4 py-2 rounded-2xl bg-[#EFE6D8] hover:opacity-90">
                                Add to Cart
                            </button>
                        </form>

                        <button id="closePromo"
                                class="flex-1 px-4 py-2 rounded-2xl bg-white border hover:opacity-90">
                            Not now
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.getElementById('closePromo')?.addEventListener('click', () => {
                // Close modal instantly (session promo_seen already set in controller)
                document.querySelector('.fixed.inset-0.z-50')?.remove();
            });
        </script>
    @endif
@endsection
