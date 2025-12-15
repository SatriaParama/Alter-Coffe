@extends('layouts.app')

@section('content')
    <div class="flex items-end justify-between gap-4">
        <div>
            <h1 class="text-3xl font-semibold">Cart</h1>
            <p class="mt-1 text-gray-600">Review your items before checkout.</p>
        </div>

        <a href="{{ route('menu') }}" class="px-4 py-2 rounded-2xl bg-white shadow hover:opacity-90">
            Back to Menu
        </a>
    </div>

    @php
        $subtotal = 0;
        foreach($cart as $item){ $subtotal += $item['price'] * $item['qty']; }
    @endphp

    @if(empty($cart))
        <div class="mt-8 rounded-3xl bg-white p-8 border">
            <p class="text-gray-700">Your cart is empty.</p>
            <a href="{{ route('menu') }}" class="inline-block mt-4 px-5 py-2 rounded-2xl bg-[#EFE6D8] hover:opacity-90">
                Explore Menu
            </a>
        </div>
    @else
        <form method="POST" action="{{ route('cart.update') }}" class="mt-8">
            @csrf
            <div class="rounded-3xl bg-white border overflow-hidden">
                <div class="divide-y">
                    @foreach($cart as $productId => $item)
                        <div class="p-5 flex flex-col sm:flex-row sm:items-center gap-4">
                            <div class="flex-1">
                                <div class="font-semibold">{{ $item['name'] }}</div>
                                <div class="text-sm text-gray-600">
                                    Rp {{ number_format($item['price'], 0, ',', '.') }}
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <input type="number"
                                       name="qty[{{ $productId }}]"
                                       value="{{ $item['qty'] }}"
                                       min="0"
                                       class="w-20 rounded-xl border px-3 py-2">

                                <form method="POST" action="{{ route('cart.remove', $productId) }}">
                                    @csrf
                                    <button formaction="{{ route('cart.remove', $productId) }}"
                                            class="px-4 py-2 rounded-2xl border hover:opacity-90">
                                        Remove
                                    </button>
                                </form>
                            </div>

                            <div class="font-semibold">
                                Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="p-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-[#FAF7F2]">
                    <button class="px-5 py-2 rounded-2xl bg-white shadow hover:opacity-90">
                        Update Cart
                    </button>

                    <div class="text-right">
                        <div class="text-sm text-gray-600">Subtotal</div>
                        <div class="text-2xl font-semibold">Rp {{ number_format($subtotal, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </form>

        <div class="mt-6 flex justify-end">
            <a href="{{ route('checkout') }}"
               class="px-6 py-3 rounded-2xl bg-[#EFE6D8] shadow hover:opacity-90">
                Proceed to Checkout
            </a>
        </div>
    @endif
@endsection
