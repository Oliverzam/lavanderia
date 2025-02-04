<?php

use Illuminate\Support\Facades\Route;
//agregamos los siguientes controladores
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\ServicioController;



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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//y creamos un grupo de rutas protegidas para los controladores
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RolController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('clientes', ClienteController::class);
    Route::resource('audits', AuditController::class);
    Route::resource('servicios', ServicioController::class);

Route::get('/audits', [AuditController::class, 'index'])->name('audits.index');
Route::delete('/audits/{id}', [AuditController::class, 'destroy'])->name('audits.destroy');
Route::get('/audits/{id}', [AuditController::class, 'show'])->name('audits.show');


});




// Route::group(['middleware' => 'no-access'], function () {
//     // Rutas a restringir
//     Route::get('clientes', [ClienteController::class, 'index'])->name('clientes.index');
//     // Agrega aquí otras rutas a restringir
// });

