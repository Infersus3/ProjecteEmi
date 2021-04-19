<?php

use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('admin.admin');
});*/

Auth::routes();

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'administrarUsers'])->name('administrar')->middleware(['auth', 'admin']);
Route::get('/admin/addAlumne/{id}', [App\Http\Controllers\AdminController::class, 'addAlumne'])->name('add_alumne');
Route::get('/admin/addProfessor/{id}', [App\Http\Controllers\AdminController::class, 'addProfessor'])->name('add_professor');
Route::get('/admin/deleteUser/{id}', [App\Http\Controllers\AdminController::class, 'deleteUser'])->name('delete_users');
