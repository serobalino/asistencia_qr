<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AsistenciaController extends Controller
{
    public function tomar(Request $datos){
        return (['datos'=>$datos,'usuario'=>auth('api')->user()]);
        /*
        $validacion =   Validator::make($datos->all(), [
            'code'  => 'required|string|size:8',
            'date'  => 'required|date',
            'time'  => 'required|date',
        ]);
        if($validacion->fails()){
            $texto  =   '';
            foreach ($validacion->errors()->all() as $errores)
                $texto.=$errores.PHP_EOL;
            return (['val'=>false,'mensaje'=>$texto]);
        }else{

            return (['val'=>true,'mensaje'=>$datos]);
        }*/
    }
}
