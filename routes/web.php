<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

<<<<<<< HEAD
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); 

<<<<<<< Updated upstream
Route::get('/creatasca' , [App\Http\Controllers\ProfessorController::class, 'index'])->name('home');
=======
Route::get('/creapractica' , [App\Http\Controllers\ProfessorController::class, 'startTasca'])->name('home');
>>>>>>> Stashed changes
=======

Route::get('/', function () {
    return view('layouts.app');
});

Route::get('/prova', [App\Http\Controllers\ProfessorController::class, 'prova2'])->name('prova');

Auth::routes();

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'administrarUsers'])->name('administrar')->middleware(['auth', 'professor']);
Route::get('/admin/addAlumne/{id}', [App\Http\Controllers\AdminController::class, 'addAlumne'])->name('add_alumne');
Route::get('/admin/addProfessor/{id}', [App\Http\Controllers\AdminController::class, 'addProfessor'])->name('add_professor');
Route::get('/admin/deleteUser/{id}', [App\Http\Controllers\AdminController::class, 'deleteUser'])->name('delete_users');

Route::get('/professor/adminGrups', [App\Http\Controllers\ProfessorController::class, 'adminGrups'])->name('admin_grups');
Route::get('/professor/crearGrups', [App\Http\Controllers\ProfessorController::class, 'crearGrup'])->name('crear_grup');
Route::get('/professor/eliminarGrups/{id}', [App\Http\Controllers\ProfessorController::class, 'eliminarGrup'])->name('eliminar_grup');
Route::get('/professor/alumne/addGrup/{idAlumne}{idGrup}', [App\Http\Controllers\ProfessorController::class, 'addAlumneGrup'])->name('add_alumne_grup');
Route::get('/professor/alumne/deleteGrup/{idAlumne}{idGrup}', [App\Http\Controllers\ProfessorController::class, 'deleteAlumneGrup'])->name('delete_alumne_grup');
>>>>>>> c7e10acb75ee4a91a98b10f6ddb7ebdb4c18fec1
