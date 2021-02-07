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
            // $table->bigInteger('kategori_id')->nullable();
            $table->bigInteger('kegiatan_id')->nullable();
            $table->string('nama');
            $table->string('slug', 270)->unique();
            $table->string('pemohon');
            // $table->string('nomorinduk');
            $table->text('latarbelakang');
            $table->text('tujuan');
            $table->text('ruanglingkup');
            $table->text('waktupencapaian');
            $table->text('luaran');
            $table->text('pembiayaan');
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
            $table->string('spj_tolak_bpp')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
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
