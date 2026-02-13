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
        Schema::create('shipping_order_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('shipping_order_id');
            $table->string('colly_no');
            $table->string('colly_type');
            $table->string('colly_description');
            $table->string('colly_sequence');
            $table->float('colly_weight');
            $table->string('colly_volume');
            $table->float('colly_length');
            $table->float('colly_width');
            $table->float('colly_height');
            $table->integer('goods_quantity');
            $table->string('currency');
            $table->string('goods_value');

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
        Schema::dropIfExists('shipping_order_detail');
    }
};
