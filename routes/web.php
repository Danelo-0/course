<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;

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

Route::get('/kurs', [IndexController::class, 'index'] )->name('kurs.index');

Route::get('/kurs/{category}', [IndexController::class, 'showCategory'] )->name('kurs.showCategory');

Route::get('/kurs/{category}/{id}', [IndexController::class, 'showСourse'] )->name('kurs.showСourse');

Route::get('/add', [IndexController::class, 'creat'] )->middleware('admin')->name('kurs.creat');

Route::post('/add', [IndexController::class, 'store'] )->middleware('admin')->name('kurs.store');

Route::delete('/kurs/{category}', [IndexController::class, 'delete'] )->middleware('admin')->name('kurs.delete');

Route::post('/kurs', [IndexController::class, 'filter'] )->name('kurs.filter');

Route::get('/profile', [IndexController::class, 'profileShow'] )->middleware('profile')->name('kurs.profile');

Route::get('/auth', [IndexController::class, 'authCreat'] )->middleware('guest')->name('kurs.creatAuth');

Route::post('/auth', [IndexController::class, 'authStore'] )->middleware('guest')->name('kurs.storeAuth');

Route::get('/logout', [IndexController::class, 'logout'])->name('login.logout');

Route::get('/registration', [IndexController::class, 'registrationCreat'] )->middleware('guest')->name('kurs.creatRegistration');

Route::post('/registration', [IndexController::class, 'registrationStore'])->middleware('guest')->name('kurs.storeRegistration');

Route::post('/kurs/{category}/{id}', [IndexController::class, 'courseEnrollment'])->middleware('auth')->name('kurs.enrollment');

Route::delete('/kurs/{category}/{id}', [IndexController::class, 'unsubscribeCourse'])->middleware('auth')->name('kurs.unsubscribe');