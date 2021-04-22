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

<<<<<<< Updated upstream
Route::get('/creatasca' , [App\Http\Controllers\ProfessorController::class, 'index'])->name('home');
=======
Route::get('/creapractica' , [App\Http\Controllers\ProfessorController::class, 'startTasca'])->name('home');
>>>>>>> Stashed changes
