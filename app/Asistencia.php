<?php

namespace App;

use App\Pre\Registrados;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class Asistencia extends Model
{
    protected $table        =       "asistencias";
    protected $primaryKey   =       "id_as";
    public $incrementing    =       false;

    protected $appends = ['tipo','creado'];

    protected $connection   =   "mysql";

    public function getTipoAttribute(){
        return $this->attributes['tipo_as'] ? 'Checkin' : 'Checkout';
    }
    public function getCreadoAttribute(){
        return Date::createFromFormat('Y-m-d H:i:s',$this->attributes['created_at'])->diffForHumans();
    }

    public function dueno(){
        return $this->hasOne(Registrados::class,"id","id_es");
    }
}
