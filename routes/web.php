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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// routes for notes

Route::get('/notes', 'web\NotesController@index')->name('notes');
Route::get('/note/create', 'web\NotesController@create')->name('note.create');
Route::post('/note/store', 'web\NotesController@store')->name('note.store');
Route::get('/note/show/{slug}', 'web\NotesController@show')->name('note.show');
Route::get('/note/edit/{id}', 'web\NotesController@edit')->name('note.edit');
Route::post('/note/update/{id}', 'web\NotesController@update')->name('note.update');
Route::get('/note/destroy/{id}', 'web\NotesController@destroy')->name('note.destroy');
