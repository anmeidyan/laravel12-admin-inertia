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
        Schema::create('log_invoice', function (Blueprint $table) {
            $table->id();
            $table->integer('status')->comment('0=pending; 1=granted; 2=reviewed; 3=approved; 4=declined');
            $table->string('method');
            $table->string('order_id');
            $table->timestamp('created_at');
            $table->integer('created_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_invoice');
    }
};
