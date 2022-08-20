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
            $table->string('jumlah_maba_reguler');
            $table->string('jumlah_maba_transfer');
            $table->string('jumlah_mahasiswa_reguler');
            $table->string('jumlah_mahasiswa_transfer');
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
