<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonaController;

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
    return view('auth.login');
});

//Route::resource('persona','App\Http\Controllers\PersonaController');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'
])->group(function () {
    Route::get('/adminLTE', function () {
        return view('adminLTE.');
    })->name('adminLTE.index');

    //Route::get('/persona', function () {
    //    return view('persona.index');
    //})->name('persona.index');
    // Esta línea de código define una ruta resource para el controlador PersonaController -> todas las clases
    Route::resource('persona',PersonaController::class);
    //Route::resource('persona','App\Http\Controllers\PersonaController');
   // Route::resource('persona/edit','App\Http\Controllers\PersonaController');

    //Route::get('/persona',[PersonaController::class,'index']);
    Route::post('persona/{persona}', 'App\Http\Controllers\PersonaController@update')->name('persona.update');

   });
