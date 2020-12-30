<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRinciansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rincians', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('permohonan_id')->nullable();
            $table->string('namapermohonan');
            $table->string('jenisbelanja');
            $table->bigInteger('biayasatuan');
            $table->string('satuan');
            $table->bigInteger('biayatotal');
            $table->Integer('volume');
            $table->bigInteger('biayaterpakai')->default(0);
            $table->bigInteger('sisabiaya')->default(0);
            $table->text('Keterangan')->nullable();
            $table->string('file')->nullable();
            $table->smallInteger('status')->default(1);
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
        Schema::dropIfExists('rincians');
    }
}
