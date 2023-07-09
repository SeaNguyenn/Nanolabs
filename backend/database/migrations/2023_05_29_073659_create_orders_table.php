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
            $table->id();
            $table->bigInteger('customer_id')->unsigned();
            $table->bigInteger('shipper_id')->unsigned();
            $table->bigInteger('shipping_method_id')->unsigned();
            $table->bigInteger('order_status_id')->unsigned();
            $table->decimal('shipping_cost',12,2);
            $table->string('note')->nullable();
            $table->date('order_date')->nullable();
            $table->date('shipped_date')->nullable();
            $table->date('shipping_required_date')->nullable();
            $table->bigInteger('state')->default(1)->comment('1:live 9:kill');
            $table->timestamps();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('shipper_id')->references('id')->on('shippers');
            $table->foreign('shipping_method_id')->references('id')->on('shipping_method');
            $table->foreign('order_status_id')->references('id')->on('order_status');
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
