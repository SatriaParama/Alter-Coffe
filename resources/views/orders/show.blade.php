@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-end justify-between gap-4">
        <div>
            <h1 class="text-3xl font-semibold">Order #{{ $order->id }}</h1>
            <p class="mt-2 text-gray-600">Payment: {{ $order->payment_status }} • Status: {{ $order->status }}</p>
        </div>
        <a href="{{ route('orders.index') }}" class="text-sm underline hover:opacity-70">Back</a>
    </div>

    <div class="mt-6 rounded-3xl bg-white border p-6">
        <h2 class="font-semibold">Items</h2>
        <div class="mt-4 space-y-3">
            @foreach($order->items as $it)
                <div class="flex items-center justify-between">
                    <div>
                        <div class="font-medium">{{ $it->product?->name ?? 'Product' }}</div>
                        <div class="text-sm text-gray-600">{{ $it->qty }} × Rp {{ number_format($it->price,0,',','.') }}</div>
                    </div>
                    <div class="font-semibold tabular-nums">
                        Rp {{ number_format($it->line_total,0,',','.') }}
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-5 h-px bg-gray-200"></div>

        <div class="mt-4 space-y-2 text-sm">
            <div class="flex justify-between"><span class="text-gray-600">Subtotal</span><span class="font-semibold tabular-nums">Rp {{ number_format($order->subtotal ?? 0,0,',','.') }}</span></div>
            <div class="flex justify-between"><span class="text-gray-600">Discount</span><span class="font-semibold tabular-nums">- Rp {{ number_format($order->discount_amount ?? 0,0,',','.') }}</span></div>
            <div class="flex justify-between text-base"><span class="font-semibold">Total</span><span class="font-semibold tabular-nums">Rp {{ number_format($order->total ?? 0,0,',','.') }}</span></div>
        </div>

        <div class="mt-6 rounded-2xl bg-[#FAF7F2] border p-4 text-sm text-gray-700">
            <div class="font-semibold">Payment Method</div>
            <div class="mt-1">{{ $order->payment_method }}</div>

            <div class="mt-4 font-semibold">QRIS / Bank / E-Wallet Instructions</div>
            <div class="mt-1 text-gray-600">
                For now, treat this as a demo flow. Next step we can add a QRIS image + upload proof (optional).
            </div>
        </div>
    </div>
</div>
@endsection
 