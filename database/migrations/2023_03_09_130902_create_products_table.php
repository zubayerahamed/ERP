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
            $table->string('title');
            $table->text('short_desc')->nullable();
            $table->text('desc')->nullable();
            $table->foreignId('thumbnail_id')->nullable()->references('id')->on('media');
            $table->foreignId('category_id')->references('id')->on('categories');
            $table->boolean('variable_product')->default(false);
            $table->foreignId('business_id')->references('id')->on('business')->onDelete('cascade');
            $table->float('rate', 8, 2)->default(0);
            $table->string('unit');
            $table->softDeletes();
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
