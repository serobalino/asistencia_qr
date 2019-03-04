<?php

namespace App\Http\Controllers;

use App\Pre\Registrados;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrController extends Controller
{
    public function crear($token){
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
            return $imagen->response();
        }else{
            return abort(404);
        }
    }
}
