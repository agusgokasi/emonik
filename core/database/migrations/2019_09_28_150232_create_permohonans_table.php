<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermohonansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permohonans', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->integer('kategori_id')->nullable();
            $table->integer('kegiatan_id')->nullable();
            $table->string('nama');
            $table->string('slug', 250)->unique();
            $table->string('pemohon');
            $table->string('nomorinduk');
            $table->text('latarbelakangkegiatan');
            $table->text('tujuankegiatan');
            $table->string('tempatkegiatan');
            $table->string('tanggalkegiatan');
            $table->text('pesertakegiatan');
            $table->text('strategipencapaiankeluaran');
            $table->text('susunanpanitia');
            $table->string('filetor');
            // $table->string('filespj')->nullable();
            $table->smallInteger('status')->default(0);
            $table->bigInteger('totalbiaya');
            $table->bigInteger('biayarincian')->default(0);
            $table->bigInteger('danaterpakai')->default(0);
            $table->bigInteger('sisarincian')->default(0);
            $table->bigInteger('sisadana')->default(0);
            $table->smallInteger('totalrincian')->default(0);
            $table->smallInteger('totalspj')->default(0);
            $table->text('keterangan')->nullable();
            $table->string('revisi')->nullable();
            $table->string('revisi2')->nullable();
            $table->string('spj_tolak_kas')->nullable();
            // $table->string('spj_tolak_ppk')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('permohonans');
    }
}
