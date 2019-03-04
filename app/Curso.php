<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table            =       "cursos";
    protected $primaryKey       =       "id_cu";
    public $timestamps          =       false;
}
