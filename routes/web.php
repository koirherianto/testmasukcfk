<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landing');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
    Route::get('/homx', [App\Http\Controllers\HomeController::class, 'home'])->name('homex');

    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::get('editProfile', [UserController::class, 'editProfile'])->name('edit.profile');
    Route::post('updateProfile', [UserController::class, 'updateProfile'])->name('update.profile');
    Route::post('updatePassword', [UserController::class, 'updatePassword'])->name('update.password');
    Route::post('updateFotoProfile', [UserController::class, 'updateFotoProfile'])->name('update.foto.profile');
    
    Route::resource('users', UserController::class);
    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::resource('permissions', App\Http\Controllers\PermissionController::class);

    Route::resource('dapartemens', App\Http\Controllers\DapartemenController::class);
    Route::resource('karyawans', App\Http\Controllers\KaryawanController::class);
    Route::get('suratPerintahLemburs/tanggapi/{id}', [App\Http\Controllers\SuratPerintahLemburController::class, 'tanggapiView'])->name('spl.tanggapi');
    Route::post('suratPerintahLemburs/tanggapi/{id}', [App\Http\Controllers\SuratPerintahLemburController::class, 'tanggapi'])->name('spl.tanggapi.post');
    Route::get('suratPerintahLemburs/{id}/timeline', [App\Http\Controllers\SuratPerintahLemburController::class, 'timeline'])->name('suratPerintahLemburs.timeline');
    Route::resource('suratPerintahLemburs', App\Http\Controllers\SuratPerintahLemburController::class);
    Route::resource('sPLStatuses', App\Http\Controllers\SPLStatusController::class);
});


Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');