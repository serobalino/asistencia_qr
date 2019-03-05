<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->longText('detalle_lo');
            $table->unsignedInteger('id_us')->nullable();
            $table->unsignedBigInteger('id_es')->nullable();
            $table->char('id_as',32)->nullable();
            $table->timestamps();

            $table->foreign('id_us')->references('id')->on('users');
            $table->foreign('id_as')->references('id_as')->on('asistencias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs',function (Blueprint $table){
            $table->dropForeign(['id_us','is_es','id_as']);
        });
    }
}
