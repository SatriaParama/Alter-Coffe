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
  Schema::create('coupons', function (Blueprint $table) {
    $table->id();
    $table->string('code')->unique(); // uppercase
    $table->enum('type', ['percent', 'fixed']);
    $table->unsignedInteger('value');
    $table->unsignedInteger('min_purchase')->nullable();
    $table->unsignedInteger('max_discount')->nullable();
    $table->unsignedInteger('quota')->nullable();
    $table->unsignedInteger('used_count')->default(0);
    $table->timestamp('start_at')->nullable();
    $table->timestamp('end_at')->nullable();
    $table->boolean('is_active')->default(true);
    $table->timestamps();
  });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
