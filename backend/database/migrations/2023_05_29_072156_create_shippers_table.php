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
        Schema::create('shippers', function (Blueprint $table) {
            $table->id();
            $table->string('shipper_name');
            $table->string('shipper_email')->nullable();
            $table->string('avatar')->nullable();
            $table->string('shipper_phone')->nullable();
            $table->string('shipper_address')->nullable();
            $table->string('create_user')->nullable();
            $table->bigInteger('modified_user')->nullable();
            $table->bigInteger('state')->default(1)->comment('1:live 9:kill');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shippers');
    }
};
