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
        Schema::create('pickup_point', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pickup_point_name', 255);
            $table->string('pickup_point_address', 255);
            $table->string('pickup_point_phone', 255);
            $table->string('pickup_point_phone_two', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pickup_point');
    }
};
