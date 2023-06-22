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
        Schema::create('sales_order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sales_order_id')->references('id')->on('sales_orders')->onDelete('cascade');
            $table->foreignId('product_id')->references('id')->on('products');
            $table->foreignId('category_id')->references('id')->on('categories');
            $table->string('product_name');
            $table->string('unit');
            $table->float('qty', 8, 2)->default(0);
            $table->float('rate', 8, 2)->default(0);
            $table->float('amount', 8, 2)->default(0);
            $table->text('note')->nullable();
            $table->foreignId('business_id')->references('id')->on('businesses')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_order_details');
    }
};
