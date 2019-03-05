<?php

namespace App\Http\Controllers;

use App\Pre\Registrados;
use Chumper\Zipper\Facades\Zipper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class RegistradosController extends Controller
{
    public function vista(){
        return view("registrados");

    }

    public function registros(){
        return Registrados::with(['discapacidad','tipo','inscripcion','documento'])->orderBy('ape_paterno')->get();
    }

    public function descargarQrs(Request $datos){
        $usu = Auth::user()->id;
        Storage::disk('tem')->deleteDirectory(Auth::user()->id);
        $a=Registrados::where('id','<',20)->get();
        foreach ($a as $item){
            app('App\Http\Controllers\QrController')->crear(md5($item->id));
        }
        $files = glob(storage_path("qrs\\$usu"));
        //Storage::disk('tem')->deleteDirectory(Auth::user()->id);
        Zipper::make(storage_path("qrs\\$usu\\files.zip"))->add($files)->close();

    }
}
