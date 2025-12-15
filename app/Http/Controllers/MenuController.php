<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\MenuPopup;
use Carbon\Carbon;

class MenuController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', true)
            ->orderBy('category')
            ->get();

        $now = now();
        $popup = MenuPopup::with('product')
            ->where('is_active', true)
            ->where(function ($q) use ($now) {
                $q->whereNull('start_at')
                  ->orWhere('start_at', '<=', $now);
            })
            ->where(function ($q) use ($now) {
                $q->whereNull('end_at')
                  ->orWhere('end_at', '>=', $now);
            })
            ->first();

        $promoSeen = session('promo_seen', false);

        // ✅ penanda agar popup hanya muncul sekali
        if ($popup && !$promoSeen) {
            session(['promo_seen' => true]);
        }

        return view('menu', compact('products', 'popup', 'promoSeen'));
    }
}
