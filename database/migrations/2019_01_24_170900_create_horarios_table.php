<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->unsignedInteger('id_cu');
            $table->date('fecha_ho');
            $table->timeTz('desde_ho');
            $table->timeTz('hasta_ho');
            $table->timestamps();

            $table->foreign('id_cu')->references('id_cu')->on('cursos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horarios',function (Blueprint $table){
            $table->dropForeign(['id_cu']);
        });
    }
}
