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
        Schema::create('order_surat_dinas', function (Blueprint $table) {
            $table->id();
            $table->foreignId("non_po_id");
            $table->string("nama_pengirim");
            $table->string("jabatan_pengirim");
            $table->string("nama_penerima");
            $table->string("jabatan_penerima");
            $table->string("sifat");
            $table->string("lampiran");
            $table->text("perihal");
            $table->text("isi_surat");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_surat_dinas');
    }
};
