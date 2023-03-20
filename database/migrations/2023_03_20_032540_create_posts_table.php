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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('shot_desc')->nullable();
            $table->text('desc')->nullable();
            $table->foreignId('thumbnail')->nullable()->references('id')->on('media');
            $table->enum('status', ['PUBLISHED','PENDING_REVIEW'])->default('PUBLISHED');
            $table->date('published_date');
            $table->time('published_time', 0);
            $table->enum('visibility', ['PUBLIC','PRIVAYE','PASSWORD_PROTECTED'])->default('PUBLIC');
            $table->boolean('sticky')->default(false);
            $table->boolean('allow_comments')->default(true);
            $table->enum('default_comment_status', ['PUBLISHED','PENDING_REVIEW'])->default('PUBLISHED');
            $table->foreignId('admin_id')->nullable()->references('id')->on('admins')->onDelete('cascade');
            $table->integer('post_visited')->default(0);
            $table->boolean('allow_likes')->default(true);
            $table->boolean('allow_ratings')->default(true);
            $table->boolean('featured_post')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
