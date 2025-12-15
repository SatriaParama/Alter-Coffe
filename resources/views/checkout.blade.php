@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-6">
        <h1 class="text-3xl font-semibold">Checkout</h1>
        <p class="mt-2 text-gray-600">Apply promo code, choose payment, then place your order.</p>
    </div>

    <form method="POST" action="{{ route('checkout.place') }}" class="space-y-6">
                {{-- CUSTOMER INFO --}}
            <div class="rounded-3xl bg-white border p-6">
                <h2 class="text-lg font-semibold">Customer Details</h2>

                <div class="mt-4 grid sm:grid-cols-2 gap-4">
                    <div>
                    <label class="text-sm text-gray-600">Name</label>
                    <input name="customer_name"
                            value="{{ old('customer_name') }}"
                            class="mt-2 w-full rounded-2xl border px-4 py-3"
                            placeholder="Your name" required>
                    </div>

                    <div>
                    <label class="text-sm text-gray-600">Phone</label>
                    <input name="phone"
                            value="{{ old('phone') }}"
                            class="mt-2 w-full rounded-2xl border px-4 py-3"
                            placeholder="08xxxxxxxxxx" required>
                    </div>
                </div>

                <div class="mt-4">
                    <label class="text-sm text-gray-600">Address (optional)</label>
                    <input name="address"
                        value="{{ old('address') }}"
                        class="mt-2 w-full rounded-2xl border px-4 py-3"
                        placeholder="Leave empty for pickup">
                </div>
                </div>


        @csrf

        <div class="rounded-3xl bg-white border p-6">
            <h2 class="text-lg font-semibold">Order Summary</h2>

            <div class="mt-4 space-y-3">
                @foreach($cart as $item)
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="font-medium">{{ $item['name'] }}</div>
                            <div class="text-sm text-gray-600">{{ $item['qty'] }} × Rp {{ number_format($item['price'],0,',','.') }}</div>
                        </div>
                        <div class="font-semibold tabular-nums">
                            Rp {{ number_format($item['price'] * $item['qty'],0,',','.') }}
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-5 h-px bg-gray-200"></div>

            <div class="mt-4 flex items-center justify-between">
                <div class="text-gray-600">Subtotal</div>
                <div class="font-semibold tabular-nums">Rp {{ number_format($subtotal,0,',','.') }}</div>
            </div>
        </div>

        <div class="rounded-3xl bg-white border p-6">
            <h2 class="text-lg font-semibold">Promo Code</h2>
            <p class="mt-2 text-sm text-gray-600">Enter your code at checkout.</p>

            <input name="promo_code"
                   value="{{ old('promo_code') }}"
                   placeholder="e.g. ALTER10"
                   class="mt-4 w-full rounded-2xl border px-4 py-3 focus:outline-none"/>
        </div>

        <div class="rounded-3xl bg-white border p-6">
            <h2 class="text-lg font-semibold">Payment Method</h2>
            <p class="mt-2 text-sm text-gray-600">Choose one method below.</p>

            @php
                $methods = [
                    'qris' => 'QRIS (Scan)',
                    'bca_va' => 'Bank BCA (VA)',
                    'bni_va' => 'Bank BNI (VA)',
                    'bri_va' => 'Bank BRI (VA)',
                    'mandiri_va' => 'Bank Mandiri (VA)',
                    'gopay' => 'GoPay',
                    'ovo' => 'OVO',
                    'dana' => 'DANA',
                    'shopeepay' => 'ShopeePay',
                    'cash' => 'Cash (Pay at store)',
                ];
            @endphp

            <div class="mt-4 grid sm:grid-cols-2 gap-3">
                @foreach($methods as $key => $label)
                    <label class="flex items-center gap-3 rounded-2xl border px-4 py-3 cursor-pointer hover:opacity-90">
                        <input type="radio" name="payment_method" value="{{ $key }}"
                               class="accent-black"
                               {{ old('payment_method','qris') === $key ? 'checked' : '' }}>
                        <span class="font-medium">{{ $label }}</span>
                    </label>
                @endforeach
            </div>

            <div class="mt-4 text-sm text-gray-600">
                QRIS: you can upload/confirm payment later (we’ll show instructions after placing the order).
            </div>
        </div>

        <div class="rounded-3xl bg-white border p-6">
            <h2 class="text-lg font-semibold">Notes</h2>
            <textarea name="notes" rows="3"
                      class="mt-3 w-full rounded-2xl border px-4 py-3 focus:outline-none"
                      placeholder="Any preference? (less ice, less sugar, etc.)">{{ old('notes') }}</textarea>
        </div>

        @if($errors->any())
            <div class="rounded-2xl bg-red-50 border border-red-200 p-4 text-red-700">
                <ul class="list-disc ml-5">
                    @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
                </ul>
            </div>
        @endif

        <button type="submit" class="w-full px-6 py-4 rounded-2xl bg-[#EFE6D8] font-semibold hover:opacity-90">
            Place Order
        </button>
    </form>
</div>
@endsection
