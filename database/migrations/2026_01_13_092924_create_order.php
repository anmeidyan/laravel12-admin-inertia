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
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->string('shipment_type');
            $table->string('shipping');
            $table->string('shipping_service');
            $table->string('shipping_type');
            $table->string('area');
            $table->float('total_length');
            $table->float('total_width');
            $table->float('total_height');
            $table->float('total_weight');
            $table->float('estimated_weight');
            $table->string('currency');
            $table->string('cost');
            $table->string('addon');
            $table->string('tax_percentage');
            $table->string('tax_value');
            $table->string('grand_total');
            $table->string('pdf_packing');
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
        Schema::dropIfExists('order');
    }
};
