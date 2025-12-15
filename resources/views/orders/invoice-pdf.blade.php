<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Receipt</title>
  <style>
    /* Thermal receipt vibe */
    @page { margin: 8px; }
    body {
      font-family: DejaVu Sans Mono, monospace;
      font-size: 10px;
      line-height: 1.2;
      color: #111;
    }

    .paper {
      width: 280px; /* ~ 80mm look on PDF */
      margin: 0 auto;
    }

    .center { text-align: center; }
    .right { text-align: right; }
    .muted { color: #444; }
    .bold { font-weight: 700; }

    .hr {
      border-top: 1px dashed #111;
      margin: 8px 0;
    }

    .row {
      display: table;
      width: 100%;
      table-layout: fixed;
    }
    .col { display: table-cell; vertical-align: top; }
    .col-left { width: 70%; }
    .col-right { width: 30%; text-align: right; }

    /* Items */
    .item-name { word-wrap: break-word; }
    .item-sub {
      display: table;
      width: 100%;
      table-layout: fixed;
      margin-top: 2px;
    }
    .item-sub .qty { display: table-cell; width: 20%; }
    .item-sub .price { display: table-cell; width: 40%; text-align: right; }
    .item-sub .total { display: table-cell; width: 40%; text-align: right; }

    .small { font-size: 9px; }
  </style>
</head>
<body>
  <div class="paper">
    <div class="center bold" style="font-size: 12px;">ALTER COFFE</div>
    <div class="center muted small">Thank you for your order</div>

    <div class="hr"></div>

    <div class="row">
      <div class="col col-left">Order</div>
      <div class="col col-right">#{{ $order->id }}</div>
    </div>
    <div class="row">
      <div class="col col-left">Date</div>
      <div class="col col-right">{{ $order->created_at->format('d/m/Y H:i') }}</div>
    </div>
    <div class="row">
      <div class="col col-left">Status</div>
      <div class="col col-right bold">{{ strtoupper($order->status) }}</div>
    </div>

    <div class="hr"></div>

    <div class="bold">CUSTOMER</div>
    <div>{{ $order->customer_name }}</div>
    <div>{{ $order->phone }}</div>
    <div class="muted">{{ $order->address }}</div>
    @if($order->notes)
      <div class="muted">Note: {{ $order->notes }}</div>
    @endif

    <div class="hr"></div>

    <div class="bold">ITEMS</div>

    @foreach($order->items as $item)
      <div class="item-name">
        {{ $item->product->name ?? $item->product_name ?? 'Item' }}
      </div>

      <div class="item-sub">
        <div class="qty">{{ $item->quantity }}x</div>
        <div class="price">Rp {{ number_format($item->price, 0, ',', '.') }}</div>
        <div class="total">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</div>
      </div>

      <div style="height:6px;"></div>
    @endforeach

    <div class="hr"></div>

    <div class="row">
      <div class="col col-left">Subtotal</div>
      <div class="col col-right">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</div>
    </div>

    <div class="row">
      <div class="col col-left">Discount</div>
      <div class="col col-right">- Rp {{ number_format($order->discount_amount ?? 0, 0, ',', '.') }}</div>
    </div>

    <div class="hr"></div>

    <div class="row" style="font-size: 12px;">
      <div class="col col-left bold">TOTAL</div>
      <div class="col col-right bold">Rp {{ number_format($order->total, 0, ',', '.') }}</div>
    </div>

    <div class="hr"></div>

    <div class="center small muted">
      -- Powered by Alter Coffe --<br>
      Keep this receipt for reference
    </div>
  </div>
</body>
</html>
