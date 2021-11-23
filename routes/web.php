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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::namespace('Guests')
->prefix('guests')
->name('guests.')
->group( function() {
    Route::resource('/', PostController::class)->only([
        'index','show'
    ]);
});

Route::middleware('auth')
->namespace('Admin')
->prefix('admin')
->name('admin.')
->group( function() {
    
    Route::get('home', 'HomeController@index')->name('home');
    Route::resource('posts', PostController::class);
    Route::resource('users', UserController::class);
});