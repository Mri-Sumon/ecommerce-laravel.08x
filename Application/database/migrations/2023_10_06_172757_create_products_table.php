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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('productName', 500)->nullable();
            $table->string('brandName', 500)->nullable();
            $table->string('productCode', 250)->nullable();
            $table->string('regularPrice', 50)->nullable();
            $table->string('productImage', 500)->nullable();
            $table->string('productImages', 500)->nullable();
            $table->string('categoryId', 50)->nullable();
            $table->string('discountType')->nullable();
            $table->string('discountAmount', 50)->nullable();
            $table->string('sellingPrice', 50)->nullable();
            $table->string('featureProduct')->nullable();
            $table->string('topSellingProduct')->nullable();
            $table->string('tag')->nullable();
            $table->text('productBrief')->nullable();
            $table->text('productDescription')->nullable();
            $table->text('brandDescription')->nullable();
            $table->string('salePrice', 50)->nullable();
            $table->string('status')->nullable();
            $table->string('sort', 11)->nullable();
            $table->string('createdBy')->nullable();
            $table->string('updatedBy')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
