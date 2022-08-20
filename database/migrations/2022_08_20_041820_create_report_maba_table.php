<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportMabaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_maba', function (Blueprint $table) {
            $table->id();
            $table->string('periode');
            $table->string('daya_tampung');
            $table->string('program_studi');
            $table->string('siswa_reguler');
            $table->string('siswa_transfer');
            $table->string('total_mahasiswa');
            $table->string('lampiran');
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
        Schema::dropIfExists('report_maba');
    }
}
