<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
  Schema::create('orders', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();

    $table->string('customer_name');
    $table->string('phone');
    $table->string('address')->nullable(); // null if pickup
    $table->text('notes')->nullable();

    $table->unsignedInteger('subtotal');
    $table->unsignedInteger('discount_amount')->default(0);
    $table->foreignId('coupon_id')->nullable()->constrained()->nullOnDelete();
    $table->string('coupon_code')->nullable();
    $table->unsignedInteger('total');

    $table->enum('status', ['pending','paid','processing','done','canceled'])->default('pending');
    $table->timestamp('payment_deadline')->nullable();
    $table->timestamps();
  });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
