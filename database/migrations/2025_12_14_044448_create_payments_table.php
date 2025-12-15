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
  Schema::create('payments', function (Blueprint $table) {
    $table->id();
    $table->foreignId('order_id')->constrained()->cascadeOnDelete();

    $table->enum('method', ['qris','bank_transfer','ewallet','cash']);
    $table->string('channel')->nullable(); // bca, bri, gopay, ovo, dana, etc.

    $table->enum('status', ['pending','paid','failed','verified'])->default('pending');
    $table->unsignedInteger('amount');

    $table->string('proof_image')->nullable(); // upload proof (bank transfer)
    $table->timestamp('paid_at')->nullable();
    $table->timestamps();
  });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
