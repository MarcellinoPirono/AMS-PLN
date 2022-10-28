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
        Schema::create('skks', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_skk')->nullable();
            $table->string('uraian_skk');
            $table->string('pagu_skk');
            $table->string('skk_terkontrak');
            $table->string('skk_realisasi');
            $table->string('skk_terbayar');
            $table->string('skk_sisa');
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
        Schema::dropIfExists('skks');
    }
};
