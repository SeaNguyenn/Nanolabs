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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('account_id')->unique();
            $table->string('password');
            $table->string('name')->nullable();
            $table->string('email');
            $table->bigInteger('role_id')->unsigned()->default(3);
            $table->string('avatar')->nullable();
            $table->bigInteger('gender')->nullable()->default(1)->comment('1: man, 2:women');
            $table->date('birthday')->nullable();
            $table->string('address')->nullable();
            $table->integer('phone')->nullable();
            $table->bigInteger('state')->default(1)->comment('1:live 9:kill');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
