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
        Schema::create('order_payment_gateway_bd', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('gateway_name', 255)->nullable();
            $table->string('store_id', 255)->nullable();
            $table->string('signature_key', 255)->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_payment_gateway_bd');
    }
};
