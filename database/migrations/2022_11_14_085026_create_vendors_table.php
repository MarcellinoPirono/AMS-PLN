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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('nama_vendor');
            $table->string('nama_direktur');
            $table->string('alamat_kantor_1');
            $table->string('alamat_kantor_2');
            $table->string('no_rek_1');
            $table->string('nama_bank_1');
            $table->string('no_rek_2');
            $table->string('nama_bank_2');
            $table->string('npwp');
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
        Schema::dropIfExists('vendors');
    }
};
