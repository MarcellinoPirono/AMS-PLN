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
    public function up()
    {
        Schema::create('rabs', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_po');
            $table->string('tanggal_po');
            $table->foreignId('skk_id')->nullable();
            $table->foreignId('prk_id')->nullable();
            // $table->foreignId('kategori_id')->nullable();
            // $table->foreignId('item_id')->nullable();
            $table->string('pekerjaan');
            $table->text('lokasi');
            $table->foreignId('nomor_kontrak_induk');
            $table->string('total_harga');
            // $table->integer('volume');
            // $table->text('isi_surat');

            $table->timestamps();
            // $table->integer("total_harga");
            // $table->string("nomor_kontrak");
            // $table->string("Pekerjaan";)
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rabs');
    }
};
