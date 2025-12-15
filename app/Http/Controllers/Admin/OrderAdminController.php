<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderAdminController extends Controller {
  public function index() {
    $orders = Order::latest()->paginate(20);
    return view('admin.orders.index', compact('orders'));
  }

  public function show(Order $order) {
    $order->load(['items.product','payment']);
    return view('admin.orders.show', compact('order'));
  }

  public function updateStatus(Request $request, Order $order) {
    $request->validate(['status' => 'required|in:pending,paid,processing,done,canceled']);
    $order->update(['status' => $request->status]);
    return back()->with('success','Order status updated.');
  }

  public function verifyPayment(Order $order) {
    $order->payment?->update(['status' => 'verified', 'paid_at' => now()]);
    $order->update(['status' => 'paid']);
    return back()->with('success','Payment verified.');
  }
}