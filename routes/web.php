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

Route::get('/creatasca' , [App\Http\Controllers\ProfessorController::class, 'index'])->name('home');
=======
Route::get('/', function () {
    return view('admin.admin');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
>>>>>>> 02e6d07a99cf1b29d7cd23c6ebb404438220038f
