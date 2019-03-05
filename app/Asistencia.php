<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $table        =       "asistencias";
    protected $primaryKey   =       "id_as";
    public $incrementing    =       false;

    protected $appends = ['tipo'];

    protected $connection   =   "mysql";

    public function getTipoAttribute(){
        return $this->attributes['tipo_as'] ? 'Checkin' : 'Checkout';
    }
}
