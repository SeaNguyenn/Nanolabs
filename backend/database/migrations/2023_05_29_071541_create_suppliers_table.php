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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('supplier_name');
            $table->string('brand_name');
            $table->string('avatar')->nullable();
            $table->string('supplier_email');
            $table->bigInteger('evaluate')->default(0)->comment('1:relly bad 2:bad 3:normal 4:good 5:relly good');
            $table->string('supplier_phone')->nullable();
            $table->string('supplier_address')->nullable();
            $table->bigInteger('state')->default(1)->comment('1:live 9:kill');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
