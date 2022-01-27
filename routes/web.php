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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/adminpanel', function () {
    return view('admin.dashboard');
});





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home/chart', [App\Http\Controllers\mycontroller::class, 'chart'])->name('chart');
Route::get('/home/barchart', [App\Http\Controllers\mycontroller::class, 'barchart'])->name('barchart');


Route::get('/home/form1', [App\Http\Controllers\mycontroller::class, 'form1'])->name('form1');
Route::get('/home/form2', [App\Http\Controllers\mycontroller::class, 'form2'])->name('form2');

Route::get('/home/product', [App\Http\Controllers\mycontroller::class, 'product'])->name('product');

Route::get('/home/editform/{id}', [App\Http\Controllers\mycontroller::class, 'editform'])->name('editform');
Route::get('/home/editform2/{id}', [App\Http\Controllers\mycontroller::class, 'editform2'])->name('editform2');

Route::post('/home/editpost2/{id}', [App\Http\Controllers\mycontroller::class, 'editpost2'])->name('editpost2');

Route::get('/home/deleteform1/{id}',[App\Http\Controllers\mycontroller::class,'deleteform1'])->name('deleteform1');

Route::post('/home/editpost/{id}', [App\Http\Controllers\mycontroller::class, 'editpost'])->name('editpost');
Route::post('/home/postform1', [App\Http\Controllers\mycontroller::class, 'postform1'])->name('postform1');
Route::post('/home/postform2', [App\Http\Controllers\mycontroller::class, 'postform2'])->name('postform2');

Route::get('/home/form3', [App\Http\Controllers\mycontroller::class, 'form3'])->name('form3');

Route::delete("/home/deleteform2",[App\Http\Controllers\mycontroller::class,'deleteform2']);


Route::get('/home/assetimage', [App\Http\Controllers\mycontroller::class, 'assetimage'])->name('assetimage');
Route::post('/home/imagepost', [App\Http\Controllers\mycontroller::class, 'imagepost'])->name('imagepost');

Route::get('/home/showimage/{id}', [App\Http\Controllers\mycontroller::class, 'showimage'])->name('showimage');
