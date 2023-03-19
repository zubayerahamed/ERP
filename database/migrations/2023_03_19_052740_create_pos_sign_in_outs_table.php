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
        Schema::create('pos_sign_in_outs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->references('id')->on('businesses');
            $table->foreignId('outlet_id')->references('id')->on('outlets');
            $table->foreignId('shop_id')->references('id')->on('shops');
            $table->foreignId('counter_id')->references('id')->on('counters');
            $table->timestamp('in_time', 0);
            $table->timestamp('out_time', 0)->nullable();
            $table->integer('shift');
            $table->date('generic_date');
            $table->enum('status', ['OPEN', 'CLOSED']);
            $table->foreignId('admin_id')->references('id')->on('admins');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pos_sign_in_outs');
    }
};
