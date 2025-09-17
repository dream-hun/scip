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
            $table->uuid()->unique();
            $table->string('order_number')->unique();
            $table->foreignId('farmer_id')->constrained('farmers');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('cooperative_id')->constrained('cooperatives');
            $table->string('name');
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('address');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

};
