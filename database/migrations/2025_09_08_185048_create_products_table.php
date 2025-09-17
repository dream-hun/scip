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
            $table->uuid()->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('price');
            $table->integer('quantity');
            $table->string('unit');
            $table->string('status')->default('available');
            $table->date('harvest_date')->nullable();
            $table->foreignId('cooperative_id')->constrained('cooperatives');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }
};
