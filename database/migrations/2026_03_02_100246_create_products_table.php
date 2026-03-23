<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // 🔥 WAJIB ADA (INI INTI BARCODE)
            $table->string('barcode')->unique();

            $table->string('name');
            $table->string('category')->default('Umum');
            $table->decimal('price', 15, 2);
            $table->integer('stock');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};