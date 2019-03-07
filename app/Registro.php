<?php

namespace App;

use App\Pre\Registrados;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    protected $table        =       "logs";
    protected $primaryKey   =       null;

    protected $connection   =       "mysql";

    public function dueno(){
        return $this->hasOne(Registrados::class,"id","id_es");
    }

    public function asistencia(){
        return $this->hasOne(Asistencia::class,"id_as","id_as");
    }
}
