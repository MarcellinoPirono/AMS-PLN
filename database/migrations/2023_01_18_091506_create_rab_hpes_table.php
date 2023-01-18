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
        Schema::create('rab_hpes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hpe_id');
            $table->foreignId('rab_non_po_id');
            $table->double('harga_perkiraan');
            $table->double('jumlah_harga_perkiraan');
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
        Schema::dropIfExists('rab_hpes');
    }
};