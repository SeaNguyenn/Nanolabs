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
            $table->foreignId('shipper_id')->nullable()->constrained('shippers','id');
            $table->foreignId('user_id')->constrained('users','id');
            $table->foreignId('shipping_method_id')->nullable()->constrained('shipping_methods','id');
            $table->bigInteger('order_status')->nullable();
            $table->decimal('shipping_cost', 10, 2);
            $table->decimal('total_amount', 10, 2);
            $table->longText('note')->nullable();
            $table->date('order_date')->nullable();
            $table->date('shipped_date')->nullable();
            $table->date('required_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
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
