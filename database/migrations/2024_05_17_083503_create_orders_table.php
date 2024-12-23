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
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->string('c_name', 255)->nullable();
            $table->string('c_phone', 255)->nullable();
            $table->string('c_email', 255)->nullable();
            $table->string('c_country', 255)->nullable();
            $table->string('c_zipcode', 255)->nullable();
            $table->string('c_address', 255)->nullable();
            $table->string('c_city', 255)->nullable();
            $table->string('subtotal', 255)->nullable();
            $table->string('total', 255)->nullable();
            $table->string('coupon_code', 255)->nullable();
            $table->string('coupon_discount', 255)->nullable();
            $table->string('after_discount', 255)->nullable();
            $table->string('payment_type', 255)->nullable();
            $table->string('tax', 255)->nullable();
            $table->string('shipping_charge', 5)->nullable();
            $table->string('order_id', 25)->nullable();
            $table->integer('status')->default(0);
            $table->string('date', 255)->nullable();
            $table->string('month', 255)->nullable();
            $table->string('year', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
