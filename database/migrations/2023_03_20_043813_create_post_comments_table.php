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
        Schema::create('post_comments', function (Blueprint $table) {
            $table->id();
            $table->text('comment');
            $table->foreignId('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->references('id')->on('users');
            $table->foreignId('admin_id')->nullable()->references('id')->on('admins');
            $table->foreignId('parent_comment')->nullable()->references('id')->on('post_comments')->onDelete('cascade');
            $table->enum('status', ['PUBLISHED','PENDING_REVIEW'])->default('PUBLISHED');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_comments');
    }
};
