@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 720px;">
  <h2>Receipt</h2>

  <div style="padding:16px;border:1px solid #ddd;border-radius:12px;margin:12px 0;">
    <div><strong>Order #{{ $order->id }}</strong></div>
    <div>Status: <strong>{{ strtoupper($order->status) }}</strong></div>
    <hr>

    <div><strong>Customer:</strong> {{ $order->customer_name }}</div>
    <div><strong>Phone:</strong> {{ $order->phone }}</div>
    <div><strong>Address:</strong> {{ $order->address }}</div>
    @if($order->notes)
      <div><strong>Notes:</strong> {{ $order->notes }}</div>
    @endif

    <hr>

    <table width="100%" cellpadding="8" style="border-collapse: collapse;">
      <thead>
        <tr style="border-bottom:1px solid #eee;">
          <th align="left">Item</th>
          <th align="center">Qty</th>
          <th align="right">Price</th>
          <th align="right">Total</th>
        </tr>
      </thead>
      <tbody>
        @foreach($order->items as $item)
          <tr style="border-bottom:1px solid #f3f3f3;">
            <td>
              {{ $item->product->name ?? $item->product_name ?? 'Item' }}
            </td>
            <td align="center">{{ $item->quantity }}</td>
            <td align="right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
            <td align="right">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <hr>

    <div style="display:flex;justify-content:space-between;">
      <div>Subtotal</div>
      <div>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</div>
    </div>

    <div style="display:flex;justify-content:space-between;">
      <div>Discount</div>
      <div>- Rp {{ number_format($order->discount_amount ?? 0, 0, ',', '.') }}</div>
    </div>

    <div style="display:flex;justify-content:space-between;font-size:18px;">
      <strong>Total</strong>
      <strong>Rp {{ number_format($order->total, 0, ',', '.') }}</strong>
    </div>

            {{-- STATUS PESANAN --}}
        <div style="margin-bottom:12px;text-align:center;">
        @if($order->status === 'pending')
            <span style="
            display:inline-block;
            padding:6px 12px;
            background:#FEF3C7;
            color:#92400E;
            border-radius:999px;
            font-size:13px;
            font-weight:600;
            ">
            ⏳ Status: Belum Dibayar
            </span>
        @elseif($order->status === 'paid')
            <span style="
            display:inline-block;
            padding:6px 12px;
            background:#DCFCE7;
            color:#166534;
            border-radius:999px;
            font-size:13px;
            font-weight:600;
            ">
            ✅ Status: Sudah Dibayar
            </span>
        @else
            <span style="
            display:inline-block;
            padding:6px 12px;
            background:#E5E7EB;
            color:#374151;
            border-radius:999px;
            font-size:13px;
            font-weight:600;
            ">
            ℹ️ Status: {{ strtoupper($order->status) }}
            </span>
        @endif
        </div>

        {{-- INVOICE / RECEIPT BOX --}}
        <div style="
        margin-top:16px;
        padding:18px;
        border:1px dashed #ddd;
        border-radius:14px;
        background:#fafafa;
        text-align:center;
        ">

        <div style="margin-bottom:6px;font-size:15px;font-weight:700;">
            🧾 Invoice / Receipt
        </div>

        <div style="font-size:13px;color:#555;margin-bottom:14px;">
            Simpan struk ini sebagai bukti pesanan Anda
        </div>

        {{-- DOWNLOAD BUTTON --}}
        <a
            href="{{ route('orders.invoice.pdf', $order) }}"
            style="
            display:inline-block;
            padding:14px 24px;
            border-radius:12px;
            font-weight:700;
            font-size:14px;
            text-decoration:none;
            color:#fff;
            background: {{ $order->status === 'paid' ? '#16A34A' : '#111827' }};
            "
        >
            ⬇ Download Invoice (PDF)
        </a>

        <div style="margin-top:10px;font-size:12px;color:#777;">
            Format struk • PDF • Siap dicetak
        </div>
    </div>

</div>

    @if($order->status === 'pending')
    <script>
        setTimeout(() => location.reload(), 3000);
    </script>
    @endif
    
@endsection
