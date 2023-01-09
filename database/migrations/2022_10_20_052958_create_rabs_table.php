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
            $table->date('tanggal_po');
            $table->foreignId('skk_id')->nullable();
            $table->foreignId('prk_id')->nullable();
            // $table->foreignId('kategori_id')->nullable();
            // $table->foreignId('item_id')->nullable();
            $table->string('pekerjaan');
           
            $table->date('startdate');
            $table->date('enddate');
            $table->foreignId('nomor_kontrak_induk');
            $table->foreignId('addendum_id')->nullable();
            $table->foreignId('pejabat_id');
            // $table->foreignId('vendor_id');
            $table->text('pengawas_pekerjaan');
            $table->text('pengawas_lapangan')->nullable();
            $table->string('total_harga');
            $table->string('pdf_file');


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
