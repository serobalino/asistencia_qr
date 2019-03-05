<?php

namespace App\Http\Controllers;

use App\Pre\Registrados;
use App\User;
use Illuminate\Http\Request;

class BackendController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function lista(){
        return Registrados::with(['discapacidad','tipo','inscripcion','documento'])->orderBy('ape_paterno')->get();
    }

}
