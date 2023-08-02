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
            $table->string('brand_name');
            $table->string('avatar')->nullable();
            $table->string('email')->unique();
            $table->bigInteger('evaluate')->default(0)->nullable();
            $table->integer('phone')->nullable();
            $table->string('address')->nullable();
            $table->bigInteger('state')->default(1);
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
