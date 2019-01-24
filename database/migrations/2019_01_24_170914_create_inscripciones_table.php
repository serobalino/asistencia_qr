<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInscripcionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscripciones', function (Blueprint $table) {
            $table->unsignedBigInteger('id_es');
            $table->unsignedInteger('id_cu');
            $table->string('observacion_in')->nullable();
            $table->timestamps();

            $table->foreign('id_cu')->references('id_cu')->on('cursos');
            $table->foreign('id_es')->references('id_es')->on('estudiantes');
            $table->primary(['id_es','id_cu']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inscripciones', function (Blueprint $table){
            $table->dropForeign(['id_cu','id_es']);
        });
    }
}
