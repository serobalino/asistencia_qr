<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->bigIncrements('id_es');
            $table->unsignedInteger('id_di')->nullable();
            $table->string('dni_es')->unique();
            $table->string('nombres_es');
            $table->string('organizacion_es');
            $table->string('email_es')->unique();
            $table->boolean('email_v_es')->default(false);
            $table->boolean('genero_es');
            $table->string('celular_es')->unique();
            $table->boolean('celular_v_es')->default(false);
            $table->boolean('discapacidad_es')->default(false);
            $table->timestamps();

            $table->foreign('id_di')->references('id_di')->on('discapacidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estudiantes', function (Blueprint $table){
            $table->dropForeign(['id_di']);
        });
    }
}
