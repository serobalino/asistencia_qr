<?php

namespace App\Http\Controllers;

use App\Asistencia;
use Illuminate\Http\Request;

class HistorialController extends Controller
{
    public function index()
    {
        return view('historial');
    }

    public function historial(){
        return Asistencia::with(['dueno','dueno.tipo'])->get();

    }
}
