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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->string('email', 255)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('user_photo', 255)->nullable();
            $table->string('password', 255);
            $table->string('phone', 255)->nullable();
            $table->tinyInteger('is_admin')->nullable();
            $table->tinyInteger('role_admin')->nullable();
            $table->string('avatar', 255)->nullable();
            $table->string('provider', 255)->nullable();
            $table->string('provider_id', 255)->nullable();
            $table->string('access_token', 255)->nullable();
            $table->integer('category')->nullable();
            $table->integer('add_product')->nullable();
            $table->integer('product_list')->nullable();
            $table->integer('brands')->nullable();
            $table->integer('developer_team')->nullable();
            $table->integer('offer')->nullable();
            $table->integer('order')->nullable();
            $table->integer('pickup')->nullable();
            $table->integer('blog')->nullable();
            $table->integer('warehouse')->nullable();
            $table->integer('report')->nullable();
            $table->integer('account')->nullable();
            $table->integer('setting')->nullable();
            $table->integer('userrole')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
