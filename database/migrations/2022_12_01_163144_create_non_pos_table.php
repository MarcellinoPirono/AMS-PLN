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
            $table->foreignId("user_id");
            $table->string("slug");
            $table->string("nomor_rpbj");
            $table->string("pekerjaan");
            $table->foreignId("skk_id");
            $table->foreignId("prk_id");
            $table->string("kak");
            $table->string("nota_dinas");
            $table->string("supervisor");
            $table->date('startdate');
            $table->date('enddate');
            $table->foreignId("pejabat_id");
            $table->double("total_harga");
            $table->string("pdf_file");
            $table->double('total_harga_hpe')->nullable();
            $table->string("status");
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
