<?php

namespace App\Pre;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    protected $connection       =       "mysql2";

    protected $table            =       "inscripcion";

    protected $appends          =       ['imagen'];

    public function getImagenAttribute(){
        return $this->attributes['foto_deposito'] ? 'https://congresoidiomas.uta.edu.ec/Data_DepositPicture_/'.$this->attributes['foto_deposito'] : null;
    }
}
