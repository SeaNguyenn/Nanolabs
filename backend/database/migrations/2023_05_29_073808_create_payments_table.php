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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->unsigned();
            $table->bigInteger('payment_method_id')->unsigned();
            $table->bigInteger('payment_status_id')->unsigned();
            $table->date('payment_date')->nullable();
            $table->decimal('total_price',12,2)->nullable();
            $table->string('note')->nullable();
            $table->bigInteger('transaction_id')->nullable();
            $table->bigInteger('state')->default(1)->comment('1:live 9:kill');
            $table->timestamps();
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('payment_status_id')->references('id')->on('payment_status');
            $table->foreign('payment_method_id')->references('id')->on('payment_method');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
