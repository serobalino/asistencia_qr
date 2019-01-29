<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscapacidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discapacidades', function (Blueprint $table) {
            $table->increments('id_di');
            $table->string('titulo_di');
        });
        DB::table('discapacidades')->insert([
            [
                'titulo_di'=>   'Visual'
            ],
            [
                'titulo_di'=>   'Auditiva'
            ],
            [
                'titulo_di'=>   'Física - Extremidades Inferiores'
            ],
            [
                'titulo_di'=>   'Física - Extremidades Superiores'
            ],
            [
                'titulo_di'=>   'Física - Tronco, Cuello, Cabeza'
            ],
            [
                'titulo_di'=>   'Intelectual'
            ],
            [
                'titulo_di'=>   'Psicológica'
            ],
            [
                'titulo_di'=>   'Sensorial'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discapacidades');
    }
}
