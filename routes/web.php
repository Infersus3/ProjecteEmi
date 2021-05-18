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

//Admin i Professor 
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ----- Administració d'usuaris i rols'
    Route::middleware(['auth', 'professor'])->group(function () {
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'administrarUsers'])->name('admin_users');
    Route::get('/admin/add_alumne/{id}', [App\Http\Controllers\AdminController::class, 'addAlumne'])->name('add_alumne');
    Route::get('/admin/add_professor/{id}', [App\Http\Controllers\AdminController::class, 'addProfessor'])->name('add_professor');
    Route::get('/admin/delete_user/{id}', [App\Http\Controllers\AdminController::class, 'deleteUser'])->name('delete_users');

//Professor 
// ----- Administració de grups
    Route::get('/professor/adminGrups', [App\Http\Controllers\ProfessorController::class, 'adminGrups'])->name('admin_grups');
    Route::get('/professor/crearGrups', [App\Http\Controllers\ProfessorController::class, 'crearGrup'])->name('crear_grup');
    Route::get('/professor/eliminar_grups/{id}', [App\Http\Controllers\ProfessorController::class, 'eliminarGrup'])->name('eliminar_grup');
    Route::get('/professor/alumne/add_grup/{idAlumne}{idGrup}', [App\Http\Controllers\ProfessorController::class, 'addAlumneGrup'])->name('add_alumne_grup');
    Route::get('/professor/alumne/delete_grup/{idAlumne}{idGrup}', [App\Http\Controllers\ProfessorController::class, 'deleteAlumneGrup'])->name('delete_alumne_grup');

// ----- Administració de pràtiques
    Route::get('/professor/admin_practica', [App\Http\Controllers\ProfessorController::class, 'adminPractica'])->name('admin_practicas');
    Route::get('/professor/crea_practica', [App\Http\Controllers\ProfessorController::class, 'creaPractica'])->name('crear_practica');
    Route::get('/professor/edita_practica/{id}', [App\Http\Controllers\ProfessorController::class, 'editaPractica'])->name('edita_practica');
    Route::get('/professor/elimina_practica/{id}', [App\Http\Controllers\ProfessorController::class, 'eliminaPractica'])->name('elimina_practica');

// ----- Administració de tàsques
    Route::get('/professor/admin_tasques/{id}', [App\Http\Controllers\ProfessorController::class, 'adminTasca'])->name('admin_tasques');
    Route::get('/professor/delete_tasca', [App\Http\Controllers\ProfessorController::class, 'deleteTasca'])->name('delete_tasca');
    Route::get('/professor/createTasca', [App\Http\Controllers\ProfessorController::class, 'createTasca'])->name('create_tasca');
    Route::get('/professor/list_tasques', [App\Http\Controllers\ProfessorController::class, 'listTasques'])->name('list_tasques');

// ----- Administració de composts
    Route::get('/professor/creacompost', [App\Http\Controllers\ProfessorController::class, 'createCompost'])->name('crear_compost');
    Route::get('/professor/admin_compost', [App\Http\Controllers\ProfessorController::class, 'adminCompost'])->name('admin_compost');
    Route::get('/professor/delete_compost/{id}', [App\Http\Controllers\ProfessorController::class, 'eliminaCompost'])->name('delete_compost');

});

// Alumne
Route::middleware(['auth', 'alumne'])->group(function () {
    
    // ----- Realitzacio de tàsques
    Route::get('/alumne/realitzaTasca/{id}', [App\Http\Controllers\AlumneController::class, 'realitzaTasca'])->name('realitza_tasca');
    Route::get('/alumne/tasques', [App\Http\Controllers\AlumneController::class, 'listTasques'])->name('tasques_alumne');

    //Agafar condicions API
    Route::get('/practica_cond/{id}', [App\Http\Controllers\AlumneController::class, 'returnCond'])->name('comprovar_cond');
});






