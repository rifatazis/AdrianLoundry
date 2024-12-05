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
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id('id_pesanan'); 
            $table->string('kode_pesanan', 10); 
            $table->unsignedBigInteger('id_user'); 
            $table->unsignedBigInteger('id_layanan'); 
            $table->float('berat'); 
            $table->float('total_harga');
            $table->date('tanggal_pesanan'); 
            $table->string('status_pesanan', 20);
            $table->timestamps(); 

            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');
            $table->foreign('id_layanan')->references('id_layanan')->on('layanan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }

};
