<?php

namespace App\Http\Controllers;

use App\Pre\Registrados;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrController extends Controller
{
    public function crear($token){
        $usu=Auth::user()->id;
        $buscar = Registrados::where(DB::raw("md5(id)"),$token)->first();
        if($buscar){
            $qr = QrCode::format('png')
                ->margin(1)
                ->size(800)
                ->color(41, 0, 0)
                ->generate($buscar->code);

            $imagen = Image::make($qr);

            $imagen->text($buscar->nombre_completo,42,790,function ($font){
                $font->file(public_path('fonts/calibrili.ttf'));
                $font->size(45);
                $font->color([41,0,0]);
            });
            $imagen->encode('png');
            Storage::disk('tem')->makeDirectory(Auth::user()->id);
            $imagen->save(storage_path("qrs\\$usu\\$buscar->id.png"));
            //return $imagen->response();
            $headers = [
                'Content-Type' => 'image/png',
                'Content-Disposition' => 'attachment; filename='. md5($buscar->id).'.png',
            ];
            return response()->stream(function() use ($imagen) {
                echo $imagen;
            }, 200, $headers);
        }else{
            return abort(404);
        }
    }

    public function generarTodos(){
        $buscar = Registrados::all();
        foreach ($buscar as $item){
            $qr = QrCode::format('png')
                ->margin(1)
                ->size(800)
                ->color(41, 0, 0)
                ->generate($item->code);

            $imagen = Image::make($qr);

            $imagen->text($item->nombre_completo,42,790,function ($font){
                $font->file(public_path('fonts/calibrili.ttf'));
                $font->size(45);
                $font->color([41,0,0]);
            });
            $imagen->encode('png');
            $imagen->save(storage_path("qrs\\'all'\\$item->nombre_completo.png"));
        }
    }
}
