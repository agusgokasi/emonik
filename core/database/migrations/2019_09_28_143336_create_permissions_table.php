<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->tinyInteger('view_status')->default(false);
            $table->tinyInteger('permission_status')->default(false);
            $table->tinyInteger('unit_status')->default(false);
            // $table->tinyInteger('kategori_status')->default(false);
            $table->tinyInteger('kegiatan_status')->default(false);
            $table->tinyInteger('exception_status')->default(false);
            $table->tinyInteger('permohonan_status')->default(false);
            $table->tinyInteger('dispo1p_status')->default(false);
            $table->tinyInteger('dispo2p_status')->default(false);
            $table->tinyInteger('dispo3p_status')->default(false);
            $table->tinyInteger('dispo4p_status')->default(false);
            $table->tinyInteger('dispo1s_status')->default(false);
            $table->tinyInteger('dispo2s_status')->default(false);

            // $table->string('data_sections')->nullable();
            $table->tinyInteger('status');
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
        Schema::dropIfExists('permission');
    }
}
