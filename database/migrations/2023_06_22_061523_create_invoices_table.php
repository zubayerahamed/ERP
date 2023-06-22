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
        Schema::create('invoices', function (Blueprint $table) {
            $table->string('id');
            $table->foreignId('sales_order_id')->references('id')->on('sales_orders')->onDelete('cascade');
            $table->date('date');
            $table->foreignId('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->enum('status', ['OPEN', 'CONFIRMED'])->default('OPEN');
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
        Schema::dropIfExists('invoices');
    }
};
