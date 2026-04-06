<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('nama_supplier');
            $table->string('nama_perusahaan')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('email')->nullable();
            $table->text('alamat')->nullable();
            $table->string('kota')->nullable();
            $table->string('kode_pos')->nullable();

            // KEUANGAN
            $table->decimal('saldo_hutang', 15, 2)->default(0);
            $table->decimal('limit_hutang', 15, 2)->default(0);
            $table->integer('jatuh_tempo')->default(0);

            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};