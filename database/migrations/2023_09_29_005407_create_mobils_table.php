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
        Schema::create('mobils', function (Blueprint $table) {
            $table->string('plat_mobil', 15)->primary();
            $table->string('nama_mobil', 20);
            $table->string('warna', 10);
            $table->string('tipe', 10);
            $table->string('tahun', 4);
            $table->date('tgl_pajak');
            $table->string('nama_pemilik', 100);
            $table->string('cc', 4);
            $table->string('harga_sewa', 10);
            $table->tinyInteger('status');
            $table->string('gambar_mobil', 255);
            $table->date('tgl_catat');
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
        Schema::dropIfExists('mobils');
    }
};
