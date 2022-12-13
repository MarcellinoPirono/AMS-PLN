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
        Schema::create('redaksis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_redaksi');
            $table->text('deskripsi_redaksi');
            $table->text('sub_deskripsi');
            // $table->id();
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
        Schema::dropIfExists('redaksis');
    }
};
