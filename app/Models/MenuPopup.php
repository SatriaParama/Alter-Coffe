<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuPopup extends Model {
  protected $fillable = ['product_id','title','is_active','start_at','end_at'];
  public function product(){ return $this->belongsTo(Product::class); }
}

