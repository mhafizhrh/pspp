<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('nisn', 100)->unique();
            $table->char('nis', 100);
            $table->char('nama', 200);
            $table->char('alamat', 200);
            $table->char('no_telp', 20);
            $table->char('id_kelas', 50);
            $table->char('id_spp', 100);
            $table->timestamps()->default('CURRENT_TIMESTAMP');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswa');
    }
}
