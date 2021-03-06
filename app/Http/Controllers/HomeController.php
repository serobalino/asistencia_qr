<?php

namespace App\Http\Controllers;

use App\Registro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function menu(){

        $usuario=Auth::user();

        $a['name']      =   "History";
        $a['icon']      =   "fa fa-bars";
        $a['url']       =   route('home');
        $aux[]          =   $a;

        if($usuario->admin){
            $a['name']      =   "All History";
            $a['icon']      =   "fa fa-list-alt";
            $a['url']       =   route('history');
            $aux[]          =   $a;

            $a['name']      =   "Registered";
            $a['icon']      =   "fa fa-ticket";
            $a['url']       =   route("registros");
            $aux[]          =   $a;

            $a['name']      =   "Attendance";
            $a['icon']      =   "fa fa-check-circle";
            $a['url']       =   route('asistencia');
            $aux[]          =   $a;

            $a['name']      =   "Users";
            $a['icon']      =   "fa fa-user";
            $a['url']       =   route("users");
            $aux[]          =   $a;
        }
        return response([
            'menu'  =>  $aux,
            'user'  =>  $usuario,
        ]);
    }

    public function historial(){
        return Registro::with(["dueno","asistencia"])
            ->where('id_us',Auth::user()->id)
            ->get();
    }
}
