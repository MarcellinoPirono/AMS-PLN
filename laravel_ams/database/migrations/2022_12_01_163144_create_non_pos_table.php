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
        Schema::create('non_pos', function (Blueprint $table) {
            $table->id();
            $table->string("nomor_rpbj");
            $table->string("pekerjaan");
            $table->foreignId("skk_id");
            $table->foreignId("prk_id");
            $table->string("kak");
            $table->string("supervisor");
            $table->foreignId("pejabat_id");
            $table->double("total_harga");
            $table->string("pdf_file");
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
        Schema::dropIfExists('non_pos');
    }
};
