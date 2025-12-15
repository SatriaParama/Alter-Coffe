<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Jobs\AutoMarkOrderPaid;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);

        // hitung subtotal dari session cart
        $subtotal = collect($cart)->sum(function ($item) {
        return $item['price'] * $item['qty'];
        });

        return view('checkout', [
            'cart' => $cart,
            'subtotal' => $subtotal,
            'discount' => session('discount', 0),
            'coupon_code' => session('coupon_code'),
        ]);
    }

    public function applyCoupon(Request $request)
    {
        $code = strtoupper(trim($request->input('promo_code', '')));

        $cart = session('cart', []);
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += ((int)$item['price']) * ((int)$item['qty']);
        }

        $coupon = Coupon::where('code', $code)->where('is_active', true)->first();

        if (!$coupon) {
            session()->forget(['coupon_code', 'discount']);
            return back()->with('error', 'Invalid promo code.');
        }

        // contoh: coupon punya type: percent/fixed dan value
        $discount = 0;

        if ($coupon->type === 'percent') {
            $discount = (int) round($subtotal * ($coupon->value / 100));
        } elseif ($coupon->type === 'fixed') {
            $discount = (int) $coupon->value;
        }

        // jangan lebih besar dari subtotal
        $discount = min($discount, $subtotal);

        session([
            'coupon_code' => $code,
            'discount' => $discount,
        ]);

        return back()->with('success', 'Promo code applied!');
    }

        public function placeOrder(Request $request)
        {
          $request->validate([
              'customer_name'   => ['required','string','max:100'],
              'phone'           => ['required','string','max:30'],
              'address'         => ['nullable','string','max:255'],
              'payment_method'  => ['required','string'],
              'notes'           => ['nullable','string'],
          ]);
        $user = auth()->user();
        $cart = session('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty.');
        }

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += ((int)$item['price']) * ((int)$item['qty']);
        }

        $discount = (int) session('discount', 0);
        $total = max(0, $subtotal - $discount);

        $couponId = null;
        if (session('coupon_code')) {
            $coupon = \App\Models\Coupon::where('code', session('coupon_code'))->first();
            $couponId = $coupon?->id;
        }

        
        $order = Order::create([
            'user_id'         => $user->id,
            'customer_name'   => $request->customer_name,
            'phone'           => $request->phone,
            'address'         => $request->address,
            'notes'           => $request->notes,

            'subtotal'        => $subtotal,
            'discount_amount' => $discount,         // ✅ ini kolom yang benar
            'total'           => $total,

            'coupon_id'       => $couponId,
            'coupon_code'     => session('coupon_code'),

            'status'          => 'pending',
            
        ]);
        
        


        foreach ($cart as $productId => $item) {
            $qty = (int) $item['qty'];
            $price = (int) $item['price'];
            $lineTotal = $qty * $price;

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => (int) $productId,
                'qty' => $qty,
                'price' => $price,
                'line_total' => $lineTotal,
            ]);
        }

        AutoMarkOrderPaid::dispatch($order->id)->delay(now()->addSeconds(5));

        // bersihin session cart + coupon
        session()->forget(['cart', 'coupon_code', 'discount']);

        return redirect()->route('orders.receipt', $order);
        
    }
}
