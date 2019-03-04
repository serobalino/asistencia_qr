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
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/app/lista','BackendController@lista');
});

Route::get('/prueba',function(){
   return \App\User::all()->where('code','57e33fd0')->first();
});
