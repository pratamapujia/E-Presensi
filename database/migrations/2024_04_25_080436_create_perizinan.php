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
        Schema::create('perizinan', function (Blueprint $table) {
            $table->id();
            $table->char('nik', 5);
            $table->date('tgl_izin');
            $table->char('keterangan', 1)->comment('i:Izin s:Sakit');
            $table->text('alasan');
            $table->char('laporan', 1)->default(0)->comment('0:Pending 1:Disetujui 2:Ditolak');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perizinan');
    }
};
