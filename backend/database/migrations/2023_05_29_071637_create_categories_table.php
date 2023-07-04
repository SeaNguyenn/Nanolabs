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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_name')->nullable();
            $table->string('brand_name')->nullable();
            $table->bigInteger('parent_id')->nullable();
            $table->bigInteger('display_order')->nullable();
            $table->string('seo_title')->nullable();
            $table->bigInteger('create_user')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->bigInteger('modified_user')->nullable();
            $table->bigInteger('state')->default(1)->comment('1:live 9:kill')->nullable();
            $table->bigInteger('state_dashboard')->default(1)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
