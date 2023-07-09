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
        Schema::table('shippers', function (Blueprint $table) {
            $table->foreign('shipping_method_id')->references('id')->on('shipping_method');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shippers', function (Blueprint $table) {
            $table->dropForeign('shipping_method_id');
        });
    }
};