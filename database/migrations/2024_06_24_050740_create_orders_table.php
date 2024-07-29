<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
          $table->id();
          $table->string('invoice_no');
          $table->string('order_tracking_id');
          $table->unsignedBigInteger('user_id');
          $table->string('payment_method');
          $table->string('delivery_charge');
          $table->decimal('total', 10, 2);
          $table->enum('status', ['pending', 'processing', 'completed', 'declined'])->default('pending');
          $table->text('remark')->nullable();
          $table->timestamps();
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
