<?php

namespace App\Http\Controllers;

use App\Asistencia;
use App\Curso;
use App\Horario;
use App\Pre\Registrados;
use App\Registro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Date\Date;

class AsistenciaController extends Controller
{
    public function tomar(Request $datos){
        $validacion =   Validator::make($datos->all(), [
            'code'  => 'required|string|size:8',
            'date'  => 'required|date',
            'time'  => 'required|date_format:H:i:s',
            'type'  => 'required|boolean',
        ]);
        if($validacion->fails()){
            $texto  =   '';
            foreach ($validacion->errors()->all() as $errores)
                $texto.=$errores.PHP_EOL;
            return (['val'=>false,'mensaje'=>$texto,'datos'=>$datos->all()]);
        }else{
            $registro   =   Registrados::all()->where('code',$datos->code)->first();
            $curso      =   Horario::where('fecha_ho',$datos->date)->first();

            $texto      =   $datos->type ? "Registered checkin" : "Registered checkout";
            if($registro && $curso){
                $anterior   =   Asistencia::where('id_es',$registro->id)->where('id_cu',$curso->id_cu)->latest()->first();
                $bandera    =   $datos->type ? "checked in" : "checked out";
                if($anterior->tipo_as!==$datos->type || $anterior===null){
                    $inscripcion            =   new Asistencia();
                    $inscripcion->id_as     =   md5($registro->id.$datos->type."$datos->date $datos->time");
                    $inscripcion->id_es     =   $registro->id;
                    $inscripcion->id_cu     =   $curso->id_cu;
                    $inscripcion->tipo_as   =   $datos->type;
                    $inscripcion->fecha_as  =   "$datos->date $datos->time";
                    $inscripcion->save();

                    $log            =   new Registro();
                    $log->id_us     =   $datos->user()->id;
                    $log->id_es     =   $registro->id;
                    $log->id_as     =   $inscripcion->id_as;
                    $log->detalle_lo=   $texto;
                    $log->save();

                    return (
                    [
                        'val'       =>  true,
                        'mensaje'   =>  $registro->nombre_principal.PHP_EOL.$texto,
                        'icon'      =>  'md-checkmark-circle-outline',
                        'color'     =>  '#d4edda'
                    ]
                    );
                }else{
                    return (
                    [
                        'val'       =>  false,
                        'mensaje'   =>  $registro->nombre_principal.PHP_EOL."has already $bandera",
                        'icon'      =>  'md-close',
                        'color'     =>  '#f2b00c'
                    ]
                    );

                }
            }else{
                return (
                    [
                        'val'       =>  false,
                        'mensaje'   =>  "No code is found".PHP_EOL."there is no course active",
                        'icon'      =>  'md-close',
                        'color'     =>  '#f8d7da'
                    ]
                );
            }
        }
    }

    public function vista(){
        return view('asistencia');
    }

    public function lista(){
        $registrados    =   Registrados::where('id',20)->get();
        foreach ($registrados as $estudiante){
            $estudiante['horas']    =   0;
            $dia        =   null;
            $tipo       =   null;
            $checkin    =   null;
            $checkout   =   null;
            foreach ($estudiante->asistencias as  $item){
                $dia        =   $item['fecha_as'];
                $tipo       =   $item['tipo_as'];
                $checkin    =   $item['tipo_as']===1 ? $item['fecha_as'] : null ;
                $checkout   =   $item['tipo_as']===0 ? $item['fecha_as'] : null ;
                if($checkin){
                    if($item['tipo_as']===0 && Date::createFromFormat('Y-m-d H:i:s',$item['fecha_as'])->isSameDay($dia)){
                        $estudiante['horas']+=Date::createFromFormat('Y-m-d H:i:s',$checkin)->diffInMinutes($item['fecha_as']);
                    }
                }
            }
        }
        return $registrados;
    }
}
