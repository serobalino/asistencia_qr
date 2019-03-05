<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function vista(){
        return view("users");
    }


    public function users(){
        return User::all();
    }

    public function cambiar(Request $datos){
        $usuario        =   User::find($datos->id);
        $usuario->admin =   !$usuario->admin;
        $usuario->save();
    }
}
