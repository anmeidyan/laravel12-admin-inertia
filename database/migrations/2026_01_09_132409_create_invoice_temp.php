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
        Schema::create('invoice_temp', function (Blueprint $table) {
            $table->id();
            $table->integer('status')->comment('0:pending; 1:approved, 2:declined');
            $table->integer('log_permission_id');
            $table->integer('order_id');
            $table->string('invoice');
            $table->string('awb');
            $table->string('goods_description');
            $table->string('grand_total');
            $table->string('shipper_name');
            $table->string('shipper_address')->nullable();
            $table->string('shipper_city')->nullable();
            $table->string('shipper_province')->nullable();
            $table->string('shipper_country')->nullable();
            $table->string('shipper_postal_code')->nullable();
            $table->string('shipper_phone')->nullable();
            $table->string('receiver_name');
            $table->string('receiver_address')->nullable();
            $table->string('receiver_city')->nullable();
            $table->string('receiver_province')->nullable();
            $table->string('receiver_country')->nullable();
            $table->string('receiver_postal_code')->nullable();
            $table->string('receiver_phone')->nullable();
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
        Schema::dropIfExists('invoice_temp');
    }
};
