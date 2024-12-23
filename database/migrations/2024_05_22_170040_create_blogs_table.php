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
        Schema::create('blogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('blog_category_id');
            $table->string('title', 255)->nullable();
            $table->string('slug', 255)->nullable();
            $table->string('publish_date', 255)->nullable();
            $table->longText('description')->nullable();
            $table->string('thumbnail', 255)->nullable();
            $table->string('tag', 255)->nullable();
            $table->integer('status')->nullable();
            $table->timestamps();

            // You might want to add indexes and foreign key constraints
            $table->foreign('blog_category_id')->references('id')->on('blog_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
