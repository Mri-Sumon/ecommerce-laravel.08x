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
        Schema::create('medias', function (Blueprint $table) {
            $table->id();
            $table->string('pictures', 1000)->nullable();
            $table->string('videos', 1000)->nullable();
            $table->string('link', 1000)->nullable();
            $table->string('title', 500)->nullable();
            $table->string('description', 1000)->nullable();
            $table->string('sections', 256)->nullable();
            $table->string('slug', 500)->nullable();
            $table->string('status', 50)->nullable();
            $table->string('sort', 50)->nullable();
            $table->string('createdBy', 50)->nullable();
            $table->string('updatedBy', 50)->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medias');
    }
};
