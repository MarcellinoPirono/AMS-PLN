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
        Schema::create('paket_pekerjaans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_paket')->nullable();
            $table->foreignId('item_id')->nullable();
            
            $table->double('volume');
            $table->string('jumlah_harga');
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
        Schema::dropIfExists('paket_pekerjaans');
    }
};
