<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Unique;

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
            $table->string('virtual_account')->unique();
            $table->string('email')->unique();
            $table->string('no_hp');
            $table->string('no_hp_ayah')->nullable();
            $table->string('no_hp_ibu')->nullable();
            $table->string('nama');
            $table->string('sekolah');
            $table->string('gelombang');
            $table->string('tahun_lulus');
            $table->string('pilihan_prodi');
            $table->string('register');
            $table->string('ujian');
            $table->string('bayar');
            $table->string('upload');
            $table->string('ukuran_baju')->nullable();            
            $table->string('periode');
            $table->string('lulus_seleksi');
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
        Schema::dropIfExists('ms_maba');
    }
}
