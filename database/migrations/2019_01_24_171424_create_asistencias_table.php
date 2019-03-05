<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsistenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asistencias', function (Blueprint $table) {
            $table->char('id_as',32);
            $table->unsignedBigInteger('id_es');
            $table->unsignedInteger('id_cu');
            $table->string('observacion_as')->nullable();
            $table->boolean('tipo_as')->nullable();
            $table->timestamps();

            $table->foreign('id_cu')->references('id_cu')->on('cursos');
            $table->primary('id_as');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asistencias', function (Blueprint $table) {
            $table->dropForeign(['id_cu']);
        });
    }
}
