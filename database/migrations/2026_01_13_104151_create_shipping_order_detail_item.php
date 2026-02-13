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
        Schema::create('shipping_order_detail_item', function (Blueprint $table) {
            $table->id();
            $table->integer('shipping_order_id');
            $table->integer('shipping_order_detail_id')->nullable();
            $table->string('hs_code');
            $table->string('name');
            $table->string('name_english');
            $table->string('quantity');
            $table->string('weight');
            $table->string('unit');
            $table->string('value');
            $table->string('manufacture_country_code');
            $table->string('currency');

            $table->timestamp('created_at');
            $table->integer('created_by');
            $table->timestamp('updated_at')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->integer('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_order_detail_item');
    }
};
