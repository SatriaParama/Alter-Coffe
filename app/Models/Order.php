<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {
  protected $fillable = [
  'user_id',
  'customer_name',
  'phone',
  'address',
  'notes',
  'subtotal',
  'discount_amount',
  'total',
  'coupon_id',
  'status',
];

  public function items(){ return $this->hasMany(OrderItem::class); }
  public function payment(){ return $this->hasOne(Payment::class); }
  public function coupon(){ return $this->belongsTo(Coupon::class); }
}

