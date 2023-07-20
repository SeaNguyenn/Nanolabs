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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained('suppliers','id');
            $table->string('name');
            $table->string('code');
            $table->string('description')->nullable();
            $table->decimal('price')->nullable();
            $table->decimal('sale_price')->nullable();
            $table->string('image')->nullable();
            $table->bigInteger('evaluate')->default(0)->nullable();
            $table->string('color')->nullable();
            $table->string('material')->nullable();
            $table->string('comment')->nullable();
            $table->bigInteger('warranty')->nullable();
            $table->bigInteger('state')->default(1)->nullable();
            $table->bigInteger('view_count')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
