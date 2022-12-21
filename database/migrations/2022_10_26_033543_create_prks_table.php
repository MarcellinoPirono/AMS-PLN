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
        Schema::create('prks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('no_skk_prk')->nullable();
            $table->string('no_prk');
            $table->string('uraian_prk');
            $table->string('pagu_prk');
            $table->string('prk_terkontrak');
            $table->string('prk_realisasi');
            $table->string('prk_terbayar');
            $table->string('prk_sisa');
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
        Schema::dropIfExists('prks');
    }
};
