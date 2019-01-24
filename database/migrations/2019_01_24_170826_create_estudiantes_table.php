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
            $table->string('dni_es')->unique();
            $table->string('nombres_es');
            $table->string('organizacion_es');
            $table->string('email_es')->unique();
            $table->boolean('email_v_es')->default(false);
            $table->string('celular_es')->unique();
            $table->boolean('celular_v_es')->default(false);
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
        Schema::dropIfExists('estudiantes');
    }
}
