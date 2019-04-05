<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Auth::routes(['verify' => true]);

Route::middleware(['verified'])->group(function () {
    Route::prefix('home')->group(function () {
        Route::get('/', 'HomeController@index')->name('home');
        Route::options('/', 'HomeController@historial');

        Route::get('/history', 'HistorialController@index')->name('history');
        Route::options('/history', 'HistorialController@historial');

        Route::get('/users','UsersController@vista')->name('users');
        Route::options('/users','UsersController@users');
        Route::post('/users','UsersController@cambiar');

        Route::get('/registered','RegistradosController@vista')->name('registros');
        Route::options('/registered','RegistradosController@registros');

        Route::get('/assistance','AsistenciaController@vista')->name('asistencia');
        Route::options('/assistance','AsistenciaController@lista');

    });

    Route::get('qr/{token}','QrController@crear')->name('generar');

    Route::prefix('app')->group(function () {
        Route::get('menu','HomeController@menu');
        Route::get('lista','BackendController@lista');
    });
});

Route::get('/a',"RegistradosController@descargarQrs");

Route::get('/prueba',function(){
   return \App\User::all()->where('code','57e33fd0')->first();
});

