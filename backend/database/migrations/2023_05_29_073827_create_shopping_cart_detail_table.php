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
        Schema::create('shopping_cart_detail', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('shopping_cart_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->decimal('unit_price',12,2)->nullable();
            $table->bigInteger('quantity')->nullable();
            $table->decimal('promotion_price',12,2)->nullable();
            $table->bigInteger('state')->default(1)->comment('1:live 9:kill');
            $table->timestamps();
        });

        Schema::table('shopping_cart_detail', function (Blueprint $table) {
            $table->foreign('shopping_cart_id')->references('id')->on('shopping_cart');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shopping_cart_detail');
    }
};
