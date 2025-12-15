@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-end justify-between gap-4">
        <div>
            <h1 class="text-3xl font-semibold">Your Orders</h1>
            <p class="mt-2 text-gray-600">Track your recent purchases.</p>
        </div>
        <a href="{{ route('menu') }}" class="text-sm underline hover:opacity-70">Back to menu</a>
    </div>

    <div class="mt-6 space-y-3">
        @forelse($orders as $order)
            <a href="{{ route('orders.show', $order) }}"
               class="block rounded-3xl bg-white border p-5 hover:opacity-90">
                <div class="flex items-center justify-between">
                    <div class="font-semibold">Order #{{ $order->id }}</div>
                    <div class="font-semibold tabular-nums">Rp {{ number_format($order->total ?? 0,0,',','.') }}</div>
                </div>
                <div class="mt-2 text-sm text-gray-600">
                    Status: {{ $order->status ?? '-' }} • Payment: {{ $order->payment_status ?? '-' }} • {{ $order->created_at?->format('d M Y, H:i') }}
                </div>
            </a>
        @empty
            <div class="rounded-3xl bg-white border p-8 text-gray-700">No orders yet.</div>
        @endforelse
    </div>

    <div class="mt-6">{{ $orders->links() }}</div>
</div>
@endsection
