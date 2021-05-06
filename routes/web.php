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


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('layouts.app');
});

Auth::routes();

//Admin i Professor 
// ----- Administració d'usuaris i rols'
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'administrarUsers'])->name('admin_users')->middleware(['auth', 'professor']);
Route::get('/admin/addAlumne/{id}', [App\Http\Controllers\AdminController::class, 'addAlumne'])->name('add_alumne');
Route::get('/admin/addProfessor/{id}', [App\Http\Controllers\AdminController::class, 'addProfessor'])->name('add_professor');
Route::get('/admin/deleteUser/{id}', [App\Http\Controllers\AdminController::class, 'deleteUser'])->name('delete_users');

//Professor 
// ----- Administració de grups
Route::get('/professor/adminGrups', [App\Http\Controllers\ProfessorController::class, 'adminGrups'])->name('admin_grups');
Route::get('/professor/crearGrups', [App\Http\Controllers\ProfessorController::class, 'crearGrup'])->name('crear_grup');
Route::get('/professor/eliminarGrups/{id}', [App\Http\Controllers\ProfessorController::class, 'eliminarGrup'])->name('eliminar_grup');
Route::get('/professor/alumne/addGrup/{idAlumne}{idGrup}', [App\Http\Controllers\ProfessorController::class, 'addAlumneGrup'])->name('add_alumne_grup');
Route::get('/professor/alumne/deleteGrup/{idAlumne}{idGrup}', [App\Http\Controllers\ProfessorController::class, 'deleteAlumneGrup'])->name('delete_alumne_grup');
// ----- Administració de pràtiques
Route::get('/professor/adminPractiques', [App\Http\Controllers\ProfessorController::class, 'adminPractiques'])->name('admin_practiques');
Route::get('/professor/adminTasca', [App\Http\Controllers\ProfessorController::class, 'adminTasca'])->name('admin_tasques');
Route::get('/professor/deleteTasca/{id}', [App\Http\Controllers\ProfessorController::class, 'deleteTasca'])->name('delete_tasca');
Route::get('/professor/createTasca', [App\Http\Controllers\ProfessorController::class, 'createTasca'])->name('create_tasca');