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
        Schema::create('shipping_order', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->string('awb');
            $table->string('courier_account')->nullable();
            $table->integer('branch')->nullable();
            $table->string('reference_no')->nullable();
            $table->string('connote')->nullable();
            $table->string('pengiriman')->nullable();
            $table->string('service')->nullable();
            $table->string('commodity')->nullable();
            $table->string('surcharge')->nullable();
            $table->string('packaging')->nullable();
            $table->string('pickup')->nullable();
            $table->integer('insurance_flag')->nullable();
            $table->string('goods_description');
            $table->string('goods_value');
            $table->string('goods_quantity');

            $table->string('interProductCode')->nullable();
            $table->string('payMethod')->nullable();
            $table->string('payMonthCard')->nullable();
            $table->string('taxPayMethod')->nullable();

            $table->string('area')->nullable();
            $table->string('shipper_name');
            $table->string('shipper_email')->nullable();
            $table->string('shipper_company')->nullable();
            $table->string('shipper_id_type')->nullable();
            $table->string('shipper_id_no')->nullable();
            $table->string('shipper_address')->nullable();
            $table->string('shipper_city')->nullable();
            $table->string('shipper_province')->nullable();
            $table->string('shipper_country')->nullable();
            $table->string('shipper_postal_code')->nullable();
            $table->string('shipper_phone')->nullable();
            $table->string('receiver_name');
            $table->string('receiver_email')->nullable();
            $table->string('receiver_company')->nullable();
            $table->string('receiver_id_type')->nullable();
            $table->string('receiver_id_no')->nullable();
            $table->string('receiver_id_front_photo')->nullable();
            $table->string('receiver_id_back_photo')->nullable();
            $table->string('receiver_address')->nullable();
            $table->string('receiver_city')->nullable();
            $table->string('receiver_province')->nullable();
            $table->string('receiver_country')->nullable();
            $table->string('receiver_postal_code')->nullable();
            $table->string('receiver_phone')->nullable();

            $table->float('weight');
            $table->float('width');
            $table->float('length');
            $table->float('height');
            $table->string('cost');
            $table->text('link_resi')->nullable();
            $table->text('label_custom')->nullable();
            $table->text('label_url')->nullable();
            $table->text('invoice_url')->nullable();

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
        Schema::dropIfExists('shipping_order');
    }
};
