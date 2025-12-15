<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller {
  public function index() {
    $cart = session('cart', []);
    return view('cart', compact('cart'));
  }

  public function add(Product $product) {
    $cart = session('cart', []);
    $id = (string)$product->id;

    if (!isset($cart[$id])) {
      $cart[$id] = [
        'name' => $product->name,
        'price' => $product->price,
        'qty' => 1,
        'image' => $product->image,
      ];
    } else {
      $cart[$id]['qty']++;
    }

    session(['cart' => $cart]);
    session()->flash('cart_bump', true);
    return back()->with('success', 'Added to cart.');
  }

  public function update(\Illuminate\Http\Request $request) {
    $cart = session('cart', []);
    foreach ($request->input('qty', []) as $productId => $qty) {
      $qty = (int)$qty;
      if ($qty <= 0) unset($cart[$productId]);
      else $cart[$productId]['qty'] = $qty;
    }
    session(['cart' => $cart]);
    return back()->with('success', 'Cart updated.');
  }

  public function remove(Product $product) {
    $cart = session('cart', []);
    unset($cart[(string)$product->id]);
    session(['cart' => $cart]);
    return back()->with('success', 'Removed from cart.');
  }
}
