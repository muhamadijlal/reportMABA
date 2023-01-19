<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswaBarusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_maba', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_report_maba');
            $table->string('nama_lengkap');        
            $table->boolean('transfer')->nullable();
            $table->bigInteger('prodi1');
            $table->string('prodi2')->nullable();
            $table->string('prodi3')->nullable();
            $table->string('prodi4')->nullable();
            $table->string('prodi5')->nullable();
            $table->string('gelombang');
            $table->boolean('ujian');
            $table->boolean('registrasi');
            $table->boolean('status_kelulusan')->nullable();
            $table->string('periode');
            $table->timestamps();


            // $table->foreign('prodi1')->references('kode_prodi')->on('ms_prodi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ms_maba');
    }
}
