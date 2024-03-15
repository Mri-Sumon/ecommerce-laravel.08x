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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('categoryIcon', 256)->nullable();
            $table->string('categoryName', 256)->nullable();
            $table->string('slug', 256)->nullable();
            $table->string('categoryImage', 500)->nullable();
            $table->string('assignParentCategory', 256)->nullable();
            $table->string('status', 50)->nullable();
            $table->string('sort', 50)->nullable();
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
        Schema::dropIfExists('categories');
    }
};
