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
            $table->foreignId('skk_id');
            $table->foreignId('prk_id');
            $table->foreignId('kategori_id');
            $table->foreignId('item_id');

            $table->string('pekerjaan');
            $table->text('lokasi');
            $table->integer('volume');
            $table->text('isi_surat');

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
