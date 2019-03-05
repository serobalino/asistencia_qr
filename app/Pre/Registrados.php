<?php

namespace App\Pre;

use App\Asistencia;
use Illuminate\Database\Eloquent\Model;

class Registrados extends Model
{
    protected $connection       =       "mysql2";

    protected $table            =       "persona";

    protected $appends          =       ['code','imagen','nombre_completo','nombre_principal'];

    public function getCodeAttribute(){
        return hash('fnv1a32',$this->attributes['id']);
    }

    public function getNombreCompletoAttribute(){
        return $this->attributes['nom_paterno']." ".$this->attributes['nom_materno']." ".$this->attributes['ape_paterno']." ".$this->attributes['ape_materno'];
    }

    public function getNombrePrincipalAttribute(){
        return $this->attributes['nom_paterno']." ".$this->attributes['ape_paterno'];
    }

    public function getImagenAttribute(){
        return route('generar',md5($this->attributes['id']));
    }

    public function discapacidad (){
        return $this->hasOne(Discapacidad::class,'id','id_dis_pert');
    }

    public function tipo (){
        return $this->hasOne(Tipo::class,'id','id_tip_ins_pert');
    }

    public function inscripcion (){
        return $this->hasOne(Inscripcion::class,'id_per_pert','id');
    }

    public function documento (){
        return $this->hasOne(Documento::class,'id','id_tip_pert');
    }

    public function asistencias(){
        return $this->hasMany(Asistencia::class,'id_es','id')->orderBy('fecha_as');
    }
}
