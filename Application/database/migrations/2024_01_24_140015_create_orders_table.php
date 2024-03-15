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
            $table->string('userId')->nullable();
            $table->string('userName')->nullable();
            $table->string('userEmail')->nullable();
            $table->string('userPhone')->nullable();
            $table->string('userAddress')->nullable();
            $table->string('productId')->nullable();
            $table->string('productImage')->nullable();
            $table->string('productName')->nullable();
            $table->string('qty')->nullable();
            $table->string('unitPrice')->nullable();
            $table->string('totalPrice')->nullable();
            $table->string('subTotal')->nullable();
            $table->string('status')->nullable();
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
