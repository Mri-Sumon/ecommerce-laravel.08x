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
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('sectionsName', 500)->nullable();
            $table->string('slug', 500)->nullable();
            $table->string('status', 500)->nullable();
            $table->string('sort', 500)->nullable();
            $table->string('createdBy', 500)->nullable();
            $table->string('updatedBy', 500)->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
