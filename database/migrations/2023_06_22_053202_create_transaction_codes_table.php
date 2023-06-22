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
        Schema::create('transaction_codes', function (Blueprint $table) {
            $table->string('trn_type');
            $table->string('trn_code');
            $table->text('desc')->nullable();
            $table->integer('starting')->default(0);
            $table->integer('increment')->default(1);
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
        Schema::dropIfExists('transaction_codes');
    }
};
