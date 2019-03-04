<?php

namespace App\Pre;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $connection       =       "mysql2";

    protected $table            =       "tipodocumento";
}
