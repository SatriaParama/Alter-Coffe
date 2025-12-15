<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuPopup;
use App\Models\Product;

class PromoAdminController extends Controller {
  public function index() {
    $products = Product::where('is_active', true)->get();
    $active = MenuPopup::with('product')->where('is_active', true)->first();
    return view('admin.promos.index', compact('products','active'));
  }

  public function activate(Request $request) {
    $request->validate([
      'product_id' => 'required|exists:products,id',
      'title' => 'required|string|max:100',
    ]);

    MenuPopup::where('is_active', true)->update(['is_active' => false]);
    MenuPopup::create([
      'product_id' => $request->product_id,
      'title' => $request->title,
      'is_active' => true,
    ]);

    return back()->with('success','Promo popup updated.');
  }
}