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
        Schema::create('karyawan', function (Blueprint $table) {
            $table->char('nik', 5)->primary();
            $table->string('nama_lengkap', 100);
            $table->string('jabatan', 20);
            $table->string('kd_departemen', 3);
            $table->string('no_hp', 13);
            $table->string('foto', 50)->nullable();
            $table->string('password', 150);
            $table->string('token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
};
