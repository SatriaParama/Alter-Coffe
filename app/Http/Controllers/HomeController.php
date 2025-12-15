<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
      {
          $coffee = Product::where('is_active', true)->where('category','coffee')->inRandomOrder()->take(2)->get();
          $tea = Product::where('is_active', true)->where('category','tea')->inRandomOrder()->take(2)->get();
          $non = Product::where('is_active', true)->where('category','non-coffee')->inRandomOrder()->take(1)->get();
          $pastry = Product::where('is_active', true)->where('category','pastry')->inRandomOrder()->take(1)->get();

          $featured = $coffee->concat($tea)->concat($non)->concat($pastry)->shuffle();

          $best = Product::where('is_active', true)->latest()->take(6)->get();

          return view('home', compact('featured','best'));
      }

}
