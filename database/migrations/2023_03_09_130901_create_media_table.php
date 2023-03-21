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
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('original_name');
            $table->string('media_type');
            $table->string('file_path');
            $table->string('alternative_name')->nullable();
            $table->string('caption')->nullable();
            $table->text('description')->nullable();
            $table->boolean('use_for_global')->default(true);
            $table->foreignId('user_id')->references('id')->on('admins')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
