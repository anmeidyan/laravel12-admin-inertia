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
        Schema::create('shipping_rates', function (Blueprint $table) {
            $table->id();
            $table->integer('courier_id');
            $table->string('courier');
            $table->string('country_code');
            $table->string('country');
            $table->string('type');
            $table->float('weight_start');
            $table->float('weight_end');
            $table->string('price');
            $table->string('service');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_rates');
    }
};
