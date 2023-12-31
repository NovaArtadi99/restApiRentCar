<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * @return void
     */
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->string('kode_transaksi', 15)->primary();
            $table->string('plat_mobil', 15);
            // $table->foreign('plat_motor')->references('plat_motor')->on('motors');
            $table->string('no_paspor', 15);
            // $table->foreign('no_paspor')->references('no_paspor')->on('penyewas');
            $table->string('id_pegawai', 15);
            // $table->foreignId('id_pegawai')->references('id')->on('users');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->integer('total');
            $table->string('km_awal', 10);
            $table->string('km_akhir', 10);
            $table->text('catatan')->nullable();
            $table->boolean('status_transaksi')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * 
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
