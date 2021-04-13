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

Route::get('/', [App\Http\Controllers\AdminController::class, 'administrarUsers'])->name('administrar');
Route::get('/admin/{id}', [App\Http\Controllers\AdminController::class, 'addAlumne'])->name('add_alumne');
